<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.components.style')

    <title>login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card mt-5 mb-0">
                    <div class="row g-0 align-items-center">
                
                        <!--end col-->
                        <div class="col-xxl-6 mx-auto">
                            <div class="card mb-0 border-0 shadow-none mb-0">
                                <div class="card-body p-sm-5  m-lg-4">
                                    <div class="p-2">
                                        <form action="{{ route('login.process') }}" method="POST">
                                            @csrf
                                            @if (session('message'))
                                                <div class="mb-3">
                                                    <div class="bg-danger">
                                                        <p class="p-2 text-light">{{ session('message') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                          
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email <span class="text-danger">*</span></label>
                                                <div class="position-relative ">
                                                    <input type="text" class="form-control  password-input" id="username" name="email" placeholder="Enter email" required="">
                                                </div>
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                    
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 password-input " name="password" placeholder="Enter password" id="password-input" required="">
                                                </div>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>
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
</body>
</html>