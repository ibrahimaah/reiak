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
                                            <p class="text-muted">قم بتسجيل الدخول للمتابعة الى اسم الشركة</p>
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
                        
                                                <div class="mt-4 pt-2 text-center">
                                                    <div class="signin-other-title position-relative">
                                                        <h5 class="fs-sm mb-4 title"> التسجيل من </h5>
                                                    </div>
                                                    <div class="pt-2 hstack gap-2 justify-content-center">
                                                        {{-- <button type="button" class="btn btn-subtle-primary btn-icon"><i class="ri-facebook-fill fs-lg"></i></button> --}}
                                                        {{-- <a href="auth/google" class="btn btn-subtle-danger btn-icon"><i class="ri-google-fill fs-2"></i></a> --}}
                                                        <a href="auth/twitter/redirect" class="btn btn-subtle-danger btn-icon"><i class="ri-twitter-fill fs-2"></i></a>
                                                        {{-- <button type="button" class="btn btn-subtle-dark btn-icon"><i class="ri-github-fill fs-lg"></i></button>
                                                        <button type="button" class="btn btn-subtle-info btn-icon"><i class="ri-twitter-fill fs-lg"></i></button> --}}
                                                    </div>
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