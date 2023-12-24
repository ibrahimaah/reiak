@extends('platform.layouts.layout')
@section('content')

<div class="card">
    <div class="card-body">

        @if(session()->has('default_image'))
            <div class='alert alert-info'>{{ session()->get('default_image') }}</div>
        @endif
        @if(session()->has('success_store'))
            <div class='alert alert-success'>{{ session()->get('success_store') }}</div>
        @endif
        @if(session()->has('error_store'))
            <div class='alert alert-danger'>{{ session()->get('error_store') }}</div>
        @endif
        {{-- <h5 class='mb-3 text-success text-center'>إضافة رأي</h5> --}}
        <form action="{{ route('vote.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="formFile" class="form-label">  عنوان الموضوع  </label>
                <input class="form-control" name="title" value="{{ old('title') }}" type="text" id="formFile" placeholder=" أدخل عنوان الرأي " required/>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="formFile" class="form-label">صورة الموضوع</label>
                <input class="form-control" name="image" type="file" id="formFile">
               {{-- @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>
            <div class="mt-4">
                <button class="btn btn-success px-4"> اضافة  </button>
            </div>
        </form>

    
</div>


<div class="card">
    <div class="card-body">
        <div class="mt-4">
            <div>
                <h5 class='mb-3 text-success text-center'>إضافة الأسئلة والاختيارات </h5>

                <!-- Accordions with Plus Icon -->
                @forelse (Auth::user()->votes->sortByDesc('created_at') as $vote)
                <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success"
                     id="accordionBordered">
                    <div class="accordion-item mt-2">
                        <h2 class="accordion-header" id="accordionborderedExample2">
                            <button class="accordion-button collapsed text-secondary bg-light border border-1 border-success" 
                                    type="button" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#accor_borderedExamplecollapse{{ $vote->id }}"
                                    aria-expanded="false" 
                                    aria-controls="accor_borderedExamplecollapse{{ $vote->id }}">
                               <span class="ms-3">{{ $vote->title }}</span>
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse{{ $vote->id }}" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample2" data-bs-parent="#accordionBordered">
                            <div class="accordion-body  tryfix"  data-id='{{ $vote->id }}'>
                                <div style="overflow-y: auto;
                                            {{ isset($vote->results[0]) ? '' : 'height:400px;' }}" >
                                    @if (isset($vote->results[0]))
                                    <div class='text-center'>
                                        <a href="{{ route('result.show',$vote->title_slug) }}" class='btn btn-success'> عرض النتائج  </a>
                                    </div>
                                    @else
                                        @if(isset($vote->questions[0]))
                                             <div class='text-center'>
                                                 <p class="text-secondary">  
                                                    لا تتوفر نتائج بعد 
                                                 </p>
                                            </div>
                                        @else
                                            <div class="list-group this col nested-list nested-sortable-handle ">
                                                <div class="list-group-item tryfix nested-1">

                                                    <i class="bi bi-plus-lg align-bottom all handle bg-success text-light position-sticky"
                                                       style="left: 0;z-index:2;cursor:pointer">
                                                    </i>

                                                    <input class="form-control question{{ $vote->id }}" type="text" id="formFile" placeholder=" أدخل السؤال ">
                                                    <div class="d-none">
                                                        <input class="form-control mt-2" type="file" id="formFile" >
                                                    </div>
                                                        <div class="list-group2 nested-list nested-sortable-handle">
                                                            <div class="list-group nested-list nested-sortable-handle">
                                                                <div class="list-group-item nested-3">
                                                                    <input class="form-control"  name="choose" type="text" id="formFile" placeholder=" أدخل الاختيار ">
                                                                </div>
                                                                <div class="list-group-item nested-3">
                                                                    <input class="form-control"  name="choose" type="text" id="formFile" placeholder=" أدخل الاختيار ">
                                                                </div>
                                                                <div class="list-group-item nested-3">
                                                                    <input class="form-control"  name="choose" type="text" id="formFile" placeholder=" أدخل الاختيار ">
                                                                </div>
                                                                <div class="list-group-item nested-3">
                                                                    <input class="form-control"  name="choose" type="text" id="formFile" placeholder=" أدخل الاختيار ">
                                                                </div>
                                                                <div class="list-group-item nested-3">
                                                                    <input class="form-control"  name="choose" type="text" id="formFile" placeholder=" أدخل الاختيار ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div> 
                                            <button class="btn btn-success submitdata mt-2"> ارسال </button>
                                        @endif
                                    @endif
                                </div>
                             
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="alert alert-info text-center">
                        قم بإضافة رأي أولاً ثم ابدأ بإضافة الأسئلة والاختيارات
                    </div>
                @endforelse
                <!-- Accordions Bordered -->

            </div>
        </div>
    </div>

    
</div>
<!-- <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script> -->
<script> 

    $(document).on('click', '.all', function() {
    // Clone the parent list-group div
    var parent = $(this).closest('.this');
    
    var newParent = parent.clone();

    // Remove the 'all' class from the clone to prevent infinite duplication

    // Clear the input values in the clone
    newParent.find('input[type="text"]').val('');
    newParent.find('input[type="file"]').val('');
    newParent.find('.handle').html('');

    // Add the cloned parent div after the original parent div
    parent.after(newParent);
});


    const btn_submit = $('.submitdata')
    btn_submit.click(function(e){
        // e.preventDefault()
        const btn_send = $(this)
        const btn_send_parent = btn_send.parents("div").parents("div")
        const dataid = btn_send_parent.attr("data-id")
        
        

        btn_send_parent.find(`.question${dataid}`).each(function(){
                const question_field = $(this); //question field
                // console.log(question_field.val());
                // const fileInput = question_field.next('div').find('input[type="file"]')[0].files[0];
            
            
                const fileInputget = question_field.next('div').find('input[type="file"]')
                const chooseInput = fileInputget.parent().next().find('input[name="choose"]');

                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('vote_id',dataid);
                
                formData.append('content', question_field.val());

                
                // formData.append('image', fileInput);
                var choice_number = 1
                if (formData.has('_token') && formData.has('vote_id')) 
                {
                    if(question_field.val())
                    {
                        btn_submit.html(`<span> تحميل </span><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);
                        btn_submit.prop('disabled',true)
                        $.ajax({
                            url: "{{ route('question.store') }}",
                            method: "POST",
                            processData: false,
                            contentType: false,
                            data: formData,
                            success: function (response) {
                                showToastMessage('تم إضافة السؤال بنجاح')
                                chooseInput.each(function(){
                                    if ($(this).val()) {
                                        $.ajax({
                                            url: "{{ route('choose.store') }}",
                                            method: "POST",
                                            data: {
                                                _token: '{{ csrf_token() }}', 
                                                question_id: response.question.id,
                                                content: $(this).val(),
                                            },
                                            success: function (response) {
                                                    showToastMessage(`تم إضافة الخيار ${choice_number} بنجاح`)
                                                    ++choice_number
                                            },
                                            error: function(xhr, status, error) {
                                                showToastMessage('حدث خطأ في إضافة الاختيارات',true)
                                                // Handle any errors that occur
                                                console.log(JSON.parse(xhr.responseText))
                                            }
                                        })   
                                    }                 
                                })},

                            error: function(xhr, status, error) {
                                    // showToastMessage('حدث خطأ في إضافة السؤال',true)
                                    showToastMessage('السؤال موجود مسبقاً .. الرجاء إضافة سؤال آخر',true)
                                    // Handle any errors that occur
                                    // console.log(JSON.parse(xhr.responseText))
                                }
                        });
                    }
                }
                else
                {
                    showToastMessage('حدث خطأ ما',true)
                }
        })      
        setTimeout(function() {
            $('.submitdata').html('ارسال')
            $('.submitdata').prop('disabled',false)
        }, 3000);
    })


</script>
@endsection