<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.components.style')
    <title>  تسجيل الدخول </title>
    <style>
        html,body{
            direction: rtl
        }
    </style>
</head>
<body>
    <section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card mb-0">
                        <div class="row g-0 align-items-center">
                            @include('platform.components.auth_intro_figure')
                            <!--end col-->
                            <div class="col-xxl-6 mx-auto">
                                <div class="card mb-0 border-0 shadow-none mb-0">
                                    <div class="card-body p-sm-5 m-lg-4">
                                        <div class="text-center mt-5">
                                            <h5 class="fs-3xl">مرحبا</h5>
                                            <p class="text-muted">قم بتسجيل الدخول للمتابعة الى المنصة </p>
                                        </div>
                                        <div class="p-2 mt-5">
                                            <form action="{{ route('login.store') }}" method="POST">
                                                @csrf
                                                @if (session('message'))
                                                <div class="mb-3">
                                                    <div class="bg-danger">
                                                        <p class="p-2 text-light">{{ session('message') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                                <!-- <div class="row"> -->
                                                    <!-- <div class="col"> -->
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label"> الايميل   <span class="text-danger">*</span></label>
                                                            <div class="position-relative ">
                                                                <input type="text" class="form-control  password-input" value="{{ old('email') }}" name="email" id="username" placeholder=" أدخل الايميل " required="">
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                            
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label" for="password-input"> كلمة السر <span class="text-danger">*</span></label>
                                                                <div class="float-end me-auto">
                                                                    <a href="auth-pass-reset.html" class="text-muted"> هل نسيت كلمة السر؟ </a>
                                                                </div>
                                                            </div>
                                                
                                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                                <input type="password" class="form-control password-input " value="{{ old('password') }}" name="password" placeholder=" أدخل كلمة السر " id="password-input" required="">
                                                                @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="mt-4">
                                                            <button class="btn btn-success w-100" type="submit"> تسجيل الدخول </button>
                                                        </div>
                                                    <!-- </div> -->
                                                    <!-- <div class="col-xs-12 col-md-6"> -->
                                                        <div class="mt-3">
                                                            <a href="auth/redirect/google" class="text-reset text-decoration-none">
                                                                <div 
                                                                    class="border border-2 d-flex justify-content-center align-items-center p-2 mb-2">

                                                                    <span class="ms-auto">
                                                                        <img src="{{ asset('assets/images/social_media_icons/google.png') }}" alt="google icon" width="30">
                                                                    </span>

                                                                    <span class="w-100 text-center text-secondary fw-bold">المتابعة باستخدام غوغل</span>

                                                                </div>
                                                            </a> 
                                                            <a href="auth/redirect/twitter" class="text-reset text-decoration-none">
                                                                <div 
                                                                    class="border border-2 d-flex justify-content-center align-items-center p-2 mb-2">

                                                                    <span class="ms-auto">
                                                                        <img src="{{ asset('assets/images/social_media_icons/twitter.png') }}" alt="twitter icon" width="30">
                                                                    </span>

                                                                    <span class="w-100 text-center text-secondary fw-bold">المتابعة باستخدام تويتر</span>

                                                                </div>
                                                            </a> 
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                            </form>
                        
                                            <div class="text-center mt-5">
                                                <p class="mb-0">  هل ليس لديك حساب ? <a href="{{ route('register.index') }}" class="fw-semibold text-secondary text-decoration-underline"> انشاء حساب  </a> </p>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    @include('admin.components.scripts')
</body>
</html>