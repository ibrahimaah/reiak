@extends('platform.layouts.layout')
@section('content')

<div class="bg-light">
    <form 
        data-action="{{ route('result.store') }}" 
        method="POST" 
        id="poll_form"
    >
        <div class="card mb-4">
            <div class="row g-0 my-2">
                <div class="col-md-12">
                    @if($vote->image !== '' && str_contains($vote->image,'videos'))

                                
                        <a data-fancybox href="#myVideo{{ $vote->id }}">
                            <img 
                                class="card-img-top"
                                style="object-fit: contain;"
                                src="{{ asset('storage/images/video_play.png') }}"
                            />
                        </a>
                        <video width="800" height="500" controls id="myVideo{{ $vote->id }}" style="display:none;">
                            <source src="{{ asset('storage/'.$vote->image) }}" type="video/mp4">
                            Your browser doesn't support HTML5 video tag.
                        </video>

                        @else
                        <img 
                            src="{{ asset('storage/'.$vote->image) }}" 
                            class='card-img-top'
                            style="object-fit: contain;"
                            onerror="this.src='{{ asset('assets/images/logo/logo.png') }}';"
                            alt="Card image cap"
                        >
                    @endif
                </div>
            </div>
            @if($is_already_participating)
                <div class="alert alert-warning text-center">
                    لقد شاركت بهذا الاستبيان من قبل
                </div>
            @endif
            @forelse ($vote->questions as $index => $q)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $q->content }}</h5>
                        </div>
                        <div class="card-body">
                            
                            @foreach ($q->chooses as $c)
                                <!-- Base Radios -->
                                <div class="form-check d-flex justify-content-start mb-2">
                                    
                                    <input 
                                        class="form-check-input ms-2" 
                                        value="{{ $c->content }}" 
                                        data-id="{{ $q->id }}" 
                                        type="radio" 
                                        name="flexRadioDefault{{ $index  }}" 
                                        id="flexRadioDefault{{ $c->id }}"
                                        required
                                        <?= $is_already_participating ? 'disabled' : '' ?>
                                    >

                                    <label class="form-check-label" for="flexRadioDefault{{ $c->id }}">
                                        {{ $c->content }}
                                    </label>
                                </div>
                            @endforeach 
                            
                        </div>
                    </div>
                </div>

            @empty
                <div class="alert alert-warning text-center">
                    هذا الاستطلاع لا يحتوي على أسئلة
                </div>
            @endforelse
        </div>

        <div class="text-center mb-2">
            @if (Auth::check())
                @if(!$is_already_participating)
                    @if($vote->questions->isNotEmpty())
                        <button class="btn btn-success w-25" id="submit_answers_btn"> ارسال </button>
                    @endif
                @else 
                    <div class="alert alert-warning text-center">
                        لقد شاركت بهذا الاستبيان من قبل
                    </div>
                    <div class="alert alert-success text-center">
                        <a href="{{ route('result.show',$vote->title_slug) }}" class="text-success text-decoration-none fw-bold"> عرض النتائج </a>
                    </div>
                @endif
            @else
                @include('platform.components.alert')
            @endif
        </div>
    </form>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script>
    $(document).ready(function() {

        var userip = ''
        var usercity = ''

        $.get("https://ipinfo.io", function(response) {
            userip = response.ip;
            usercity = response.city;
        }, "json")

        var answers = [];

        $('#poll_form').on('submit', (e) => {
            
            e.preventDefault()
            var store_result_url = $('#poll_form').attr('data-action')

            $('input[type=radio]:checked').each(function() {
                var questionId = $(this).attr('data-id');
                var answerId = $(this).attr('id').replace('flexRadioDefault', '');
                answers.push({
                    ip:userip || 'unknown',
                    city:usercity  || 'unknown',
                    question_id: questionId,
                    answer_id: answerId,
                    content:$(this).val()
                });
            });
            
            $.ajax({
                url: store_result_url,
                method:'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // processData: false,
                // contentType: false,
                data: {answers,survey_id:'{{ $vote->id }}'} ,
                beforeSend: function() {
                    $('#submit_answers_btn').addClass('disabled')
                    showOverlayWithMessage(waiting_msg);
                },
                complete: function() {
                    hideOverlay();
                },
                success:(response)=>{
                    if (response.success == 0) {
                        showToastMessage(response.msg,true)
                    }else if(response.success == 1){
                        showToastMessage(response.msg)
                        window.location.href = "{{ route('result.show',$vote->title_slug) }}"
                    }
                },
                error:()=>{
                    showToastMessage(err_msg,true)
                    $('#submit_answers_btn').removeClass('disabled')
                }
            });
            // $(this).prop('enabled')
           
            
        });
    });
</script>



@endsection