<!-- Default Modals -->
<button type="button" class="btn btn-success m-2 w-25 " id="submitAnswers" data-bs-toggle="modal" data-bs-target="#myModal"> ارسال </button>
    <div id="myModal" class="modal fade" tabindex="-1" data-bs-backdrop='static' aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-end">
               {{-- <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"> </button> --}}
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                <div class="mt-4">
                    <h4 class="mb-3">عفوا قم بتسجيل الدخول !</h4>
                    <p class="text-muted mb-4">  أنت تستخدم الموقع بدون حساب قم بتسجيل دخولك او أنشأ حسابا جديدا لرؤية نتائج الاستطلاع . </p>
                    <div class="hstack gap-2 justify-content-center">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal"> اغلاق </button> --}}
                        <a href="{{ route('register.index') }}" class="btn btn-danger"> تسجيل الدخول </a>
                    </div>
                </div>
            </div>
          

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->