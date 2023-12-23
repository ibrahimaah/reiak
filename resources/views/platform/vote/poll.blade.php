@extends('platform.layouts.layout')
@section('content')

<div class="bg-light">
        <div class="card mb-4">
            <div class="row g-0 my-2">
                <div class="col-md-12">
                    <img class="rounded-start img-fluid h-100 object-cover" src="{{ asset('files/'.$votes->image) }}" alt="Card image">
                </div>
    @forelse ($votes->questions as $index => $q)
                    <div class="col-md-12">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $q->content }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($q->chooses as $c)
                            <!-- Base Radios -->
                            <div class="form-check d-flex justify-content-start mb-2">
                                <input class="form-check-input ms-2" value="{{ $c->content }}" data-id="{{ $q->id }}" type="radio" name="flexRadioDefault{{ $index  }}" id="flexRadioDefault{{ $c->id }}">
                                <label class="form-check-label" for="flexRadioDefault{{ $c->id }}">
                                    {{ $c->content }}
                                </label>
                            </div>

                            @endforeach 
                        </div>
                    </div>

    @empty
        <!-- Handle the case when there are no questions -->
    @endforelse
</div>

<div class="text-center mb-2 submitme">
    @if (Auth::check())
        <button class="btn btn-success w-25" id="submitAnswers"> ارسال </button>
    @else
        @include('platform.components.alert')
    @endif
</div>
</div>
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
        $('#submitAnswers').click(function() {
            $('.submitme').html(`
                <button class="btn btn-success  w-25" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> تحميل...
                </button>

            `);
            $(this).prop('disabled',true)
            // استعراض جميع الإجابات المختارة
            var answers = [];

            $('input[type=radio]:checked').each(function() {
                var questionId = $(this).attr('data-id');
                var answerId = $(this).attr('id').replace('flexRadioDefault', '');

                answers.push({
                    ip:userip || 'unknown',
                    city:usercity  || 'unknown',
                    survey_id:'{{ $votes->id }}',
                    question_id: questionId,
                    answer_id: answerId,
                    content:$(this).val()
                });
            });
            // إرسال الإجابات إلى الخادم باستخدام Ajax
            $.ajax({
                type: 'POST',
                url: '{{ route("result.store") }}', // تعديل هذا الرابط بناءً على تكوين مسار الخادم الخاص بك
                data: { _token: '{{ csrf_token() }}',answers:answers},
                success: function(response) {
                    console.log(response);
                    Toastify({
                        text: " تمت المعالجة بنجاح ",
                        className: "info",
                        style: {
                            background: "#2dcb73",
                        }
                    }).showToast();
                    // يمكنك إضافة المزيد من المعالجة هنا بناءً على الاحتياجات الخاصة بك
                },
                error: function(error) {
                    Toastify({
                    text: " فشلت المعالجة ",
                    className: "info",
                    style: {
                        background: "#ff6c6c",
                    }
                    }).showToast();
                    @auth
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                    @endauth
                  
                }
            });
            // $(this).prop('enabled')
           
            
        });
    });
</script>



@endsection