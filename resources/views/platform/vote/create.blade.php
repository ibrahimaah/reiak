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
            <button type="submit" class="btn btn-success" id="submit_button">إضافة</button>
        </form>

    </div>
</div>

    
<script src="{{ asset('assets/js/jquery.replicate.js') }}"></script>
<script>
    

    const selector = '[data-x-wrapper]';
    let options = {
        disableNaming: '[data-disable-naming]',
        wrapper: selector,
        group: '[data-x-group]',
        addBtn: '[data-add-btn]',
        removeBtn: '[data-remove-btn]'
    };

    $(selector).replicate(options);
    
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
                    $('#submit_button').addClass('disabled')
                    showOverlayWithMessage(waiting_msg);
                },
                complete: function() {
                    hideOverlay();
                    $('#submit_button').removeClass('disabled')
                },
                success:(response)=>{
                    if (response.success == 0) {
                        showToastMessage(response.msg,true)
                    }else if(response.success == 1){
                        showToastMessage(response.msg)
                        form.trigger("reset");
                    }
                },
                error:()=>{
                    showToastMessage(err_msg,true)
                }
        })

    })
</script>

@endsection