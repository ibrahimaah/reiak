@extends('platform.layouts.layout')
@section('content')

<div class="col-xxl-9 mx-auto">
    <div class="mb-0 border-0 shadow-none mb-0">
        <div class="card-body p-sm-5 m-lg-4">
            <div class="error-img text-center px-5">
                <img src="{{ asset('assets/images/auth/404.png') }}" class="img-fluid" alt="">
            </div>
            <div class="mt-4 text-center pt-3">
                <div class="position-relative">
                    <h4 class="fs-2xl error-subtitle text-uppercase mb-0"> عفرا, الصفحة غير متوفرة </h4>
                    <p class="fs-base text-muted mt-3"> هده الصفحة التي قمت بطلبها غير موجودة او ربما تم حذفها. </p>
                    <div class="mt-4">
                        <a href="/" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>  الصفحة الرئيسية </a>
                    </div>
                </div>
            </div>
        </div><!-- end card body -->
    </div><!-- end card -->
</div>

@endsection