@extends('platform.layouts.layout')
@section('content')


    <section class="auth-page-wrapper position-relative d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card mb-0">
                        <div class="row g-0 align-items-center">
                            
                            <!--end col-->
                            <div class="col-xxl-6 mx-auto">
                                <div class="card mb-0 border-0 shadow-none mb-0">
                                    
                                    <div class="card-body">
                                        <div class="text-center mt-5 row align-items-center justify-content-center">
                                            <div class="col-md-8">
                                                <h5 class="fs-3xl">مرحبا</h5>
                                                <p class="text-muted">قم بانشاء حساب للمتابعة الى منصة وش رايك </p>
                                            </div>
                                            <div class="d-none d-md-block col-md-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/logo/logo.png') }}"
                                                    alt="Logo"
                                                />
                                            </div>
                                        </div>
   
                                        <div class="p-2 mt-5">
                                            <form action="{{ route('register.store') }}" method="POST">
                                                @csrf
                                                @if (session('message'))
                                                    <div class="mb-3">
                                                        <div class="bg-danger">
                                                            <p class="p-2 text-light">{{ session('message') }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label">  الاسم   <span class="text-danger">*</span></label>
                                                    <div class="position-relative ">
                                                        <input type="text" 
                                                                class="form-control" 
                                                                value="{{ old('name') }}" 
                                                                name="name" required
                                                        />
                                                    </div>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label"> الايميل   <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="position-relative ">
                                                        <input type="text" 
                                                            class="form-control password-input" 
                                                            name="email" value="{{ old('email') }}" dir="ltr" required
                                                        />
                                                    </div>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="form-label"> كلمة المرور <span class="text-danger">*</span></label>
                                                    </div>
                                            
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" 
                                                            class="form-control password-input"
                                                            name="password" dir="ltr" required
                                                        />
                                                        @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="form-label"> تأكيد كلمة المرور <span class="text-danger">*</span></label>
                                                    </div>
                                            
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" 
                                                            class="form-control password-input"
                                                            name="password_confirmation"
                                                            dir="ltr"
                                                            required
                                                        />
                                                        @error('confirm_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit"> إنشاء حساب  </button>
                                                </div>
                    
                                            
                                            </form>
                
                                            <div class="text-center mt-5">
                                                <p class="mb-0">  هل لديك حساب ؟ <a href="{{ route('login.index') }}" class="fw-semibold text-secondary text-decoration-underline"> تسجيل الدخول  </a> </p>
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

@endsection