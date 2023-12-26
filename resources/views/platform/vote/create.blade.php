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
        <form method="post" enctype="multipart/form-data" id="addVoteForm">
            {{-- @csrf --}}
            <div>
                <label for="vote_title" class="form-label text-success">  عنوان الموضوع  </label>
                <input class="form-control"
                       name="title" 
                       type="text"
                       id="vote_title"
                       placeholder=" أدخل عنوان الموضوع "
                       required
                />
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="form-label text-success">أضف صورة/فيديو</label>
                <input class="form-control upload-file"
                       name="image"
                       id="img_or_video"
                       type="file"/>
                       
               {{-- @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>
            <div class="mt-4">
                <label class="form-label text-success">الأسئلة والاختيارات</label>
                <div>
                    <div data-x-wrapper="questions">
                        <div data-x-group class="position-relative">
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    name="question" 
                                    class="form-control w-75 border border-secondary" 
                                    placeholder="أدخل السؤال" 
                                    required />
                            </div>
                            <div class="mb-3">
                                <div class="list-group">
                                <input type="text" name="choice1" class="form-control list-group-item mb-2 me-5 w-75 border border-secondary" placeholder="الخيار 1" required />
                                <input type="text" name="choice2" class="form-control list-group-item mb-2 me-5 w-75 border border-secondary" placeholder="الخيار 2" required />
                                <input type="text" name="choice3" class="form-control list-group-item mb-2 me-5 w-75 border border-secondary" placeholder="الخيار 3" />
                                <input type="text" name="choice4" class="form-control list-group-item mb-2 me-5 w-75 border border-secondary" placeholder="الخيار 4" />
                                </div>
                            </div>
                           
                            <div id="actions" class="mb-3 d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-success" data-add-btn>
                                    <i class="fas fa-plus"></i> أضف سؤالاً آخر  
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger position-absolute"
                                        style="left:0;top:0"
                                        data-remove-btn>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">إضافة</button>
        </form>

    </div>
</div>




    
<script src="{{ asset('assets/js/jquery.replicate.js') }}"></script>
<script>
    // Show overlay
    function showOverlayWithMessage(message) {
        $("<div id='overlay'></div>")
            .css({
                position: "fixed",
                top: 0,
                left: 0,
                width: "100%",
                height: "100%",
                background: "rgba(0, 0, 0, 0.5)",
                zIndex: 9999,
                display: "flex",
                justifyContent: "center",
                alignItems: "center"
            })
            .html(`<div id='overlay-message' class='alert alert-success'>${message}</div>`)
            .appendTo("body");
    }
    // Hide overlay
    function hideOverlay() {
        $("#overlay").remove();
    }


    const selector = '[data-x-wrapper]';
    let options = {
        disableNaming: '[data-disable-naming]',
        wrapper: selector,
        group: '[data-x-group]',
        addBtn: '[data-add-btn]',
        removeBtn: '[data-remove-btn]'
    };

    $(selector).replicate(options);



    //hiding trash icon from first form
    // $('[data-add-btn]').on('click',()=>{
        // $('#addVoteForm > div:nth-child(3) > div > div > div:nth-child(1) button.btn-outline-danger').addClass('invisible')
        // $('#addVoteForm > div:nth-child(3) > div > div > div:nth-child(1) button.btn-outline-success').on('click',()=>{
        //     $('#addVoteForm > div:nth-child(3) > div > div > div:nth-child(2) button.btn-outline-danger').addClass('btn-lg')
        // })
    // })
    
    // $('[data-x-group="0"]').addClass('invisible')
    
    

    const form = $('#addVoteForm');

    $(form).on('submit', (e) => {
        e.preventDefault()
        let fd = $(form).serializeArray()
    
        //if there is img_or_video then add it else skip
        let img_or_video = $('#img_or_video')[0].files[0]
        if ($('#img_or_video')[0].files[0]) {
            fd = [...fd, {name: 'image',value: img_or_video}]
        }

        let formData = new FormData();
        for (let i = 0; i < fd.length; i++) {
            formData.append(fd[i].name, fd[i].value);
        }
        const waiting_msg = 'جاري المعالجة ...'
        const err_msg = 'حدث خطأ في المعالجة'

        $.ajax({
                url: "{{ route('vote.store') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                contentType: false,
                data: formData, 
                beforeSend: function() {
                    showOverlayWithMessage(waiting_msg);
                },
                complete: function() {
                    hideOverlay();
                    // $(form).reset()
                },
                success:(response)=>{
                    if (response.success == 0) {
                        showToastMessage(response.msg,true)
                    }else if(response.success == 1){
                        showToastMessage(response.msg)
                    }
                },
                error:()=>{
                    showToastMessage(err_msg,true)
                }
        })

    })
</script>
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