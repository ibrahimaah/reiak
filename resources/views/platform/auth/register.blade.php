<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.components.style')
    <title> تسجيل حساب </title>
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
                <div class="col-lg-11">
                    <div class="card mb-0">
                        <div class="row g-0 align-items-center">
                            @include('platform.components.auth_intro_figure')
                            <!--end col-->
                            <div class="col-xxl-6 mx-auto">
                                <div class="card mb-0 border-0 shadow-none mb-0">
                                    <div class="card-body p-sm-5 m-lg-4">
                                        <div class="text-center mt-5">
                                            <h5 class="fs-3xl">مرحبا</h5>
                                            <p class="text-muted">قم بانشاء حساب للمتابعة الى اسم الشركة</p>
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
                                                    <label for="username" class="form-label">  الاسم   <span class="text-danger">*</span></label>
                                                    <div class="position-relative ">
                                                        <input type="text" class="form-control  password-input" value="{{ old('name') }}" name="name" id="username" placeholder=" أدخل الاسم " required="">
                                                    </div>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="number" class="form-label"> رقم الهاتف   <span class="text-danger">*</span></label>
                                                    <div class="position-relative ">
                                                        <input type="text" class="form-control  password-input" value="{{ old('number') }}" name="number" id="username" placeholder=" أدخل رقم الهاتف " required="">
                                                    </div>
                                                    @error('number')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
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
                                                    <label for="username" class="form-label"> تاريخ الميلاد   <span class="text-danger">*</span></label>
                                                    <div class="position-relative ">
                                                        <select class="form-select mb-3" name="birth" aria-label="Default select example">
                                                            <option value="1434">1434 هـ</option>
                                                            <option value="1433">1433 هـ</option>
                                                            <option value="1432">1432 هـ</option>
                                                            <option value="1431">1431 هـ</option>
                                                            <option value="1430">1430 هـ</option>
                                                            <option value="1429">1429 هـ</option>
                                                            <option value="1428">1428 هـ</option>
                                                            <option value="1427">1427 هـ</option>
                                                            <option value="1426">1426 هـ</option>
                                                            <option value="1425">1425 هـ</option>
                                                            <option value="1424">1424 هـ</option>
                                                            <option value="1423">1423 هـ</option>
                                                            <option value="1422">1422 هـ</option>
                                                            <option value="1421">1421 هـ</option>
                                                            <option value="1420">1420 هـ</option>
                                                            <option value="1419">1419 هـ</option>
                                                            <option value="1418">1418 هـ</option>
                                                            <option value="1417">1417 هـ</option>
                                                            <option value="1416">1416 هـ</option>
                                                            <option value="1415">1415 هـ</option>
                                                            <option value="1414">1414 هـ</option>
                                                            <option value="1413">1413 هـ</option>
                                                            <option value="1412">1412 هـ</option>
                                                            <option value="1411">1411 هـ</option>
                                                            <option value="1410">1410 هـ</option>
                                                            <option value="1409">1409 هـ</option>
                                                            <option value="1408">1408 هـ</option>
                                                            <option value="1407">1407 هـ</option>
                                                            <option value="1406">1406 هـ</option>
                                                            <option value="1405">1405 هـ</option>
                                                            <option value="1404">1404 هـ</option>
                                                            <option value="1403">1403 هـ</option>
                                                            <option value="1402">1402 هـ</option>
                                                            <option value="1401">1401 هـ</option>
                                                            <option value="1400">1400 هـ</option>
                                                            <option value="1399">1399 هـ</option>
                                                            <option value="1398">1398 هـ</option>
                                                            <option value="1397">1397 هـ</option>
                                                            <option value="1396">1396 هـ</option>
                                                            <option value="1395">1395 هـ</option>
                                                            <option value="1394">1394 هـ</option>
                                                            <option value="1393">1393 هـ</option>
                                                            <option value="1392">1392 هـ</option>
                                                            <option value="1391">1391 هـ</option>
                                                            <option value="1390">1390 هـ</option>
                                                            <option value="1389">1389 هـ</option>
                                                            <option value="1388">1388 هـ</option>
                                                            <option value="1387">1387 هـ</option>
                                                            <option value="1386">1386 هـ</option>
                                                            <option value="1385">1385 هـ</option>
                                                            <option value="1384">1384 هـ</option>
                                                            <option value="1383">1383 هـ</option>
                                                            <option value="1382">1382 هـ</option>
                                                            <option value="1381">1381 هـ</option>
                                                            <option value="1380">1380 هـ</option>
                                                            <option value="1379">1379 هـ</option>
                                                            <option value="1378">1378 هـ</option>
                                                            <option value="1377">1377 هـ</option>
                                                            <option value="1376">1376 هـ</option>
                                                            <option value="1375">1375 هـ</option>
                                                            <option value="1374">1374 هـ</option>
                                                            <option value="1373">1373 هـ</option>
                                                            <option value="1372">1372 هـ</option>
                                                            <option value="1371">1371 هـ</option>
                                                            <option value="1370">1370 هـ</option>
                                                        </select>
                                                          
                                                    </div>
                                                    @error('birth')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">  الجنس   <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <div class="form-check d-flex justify-content-start mb-2">
                                                            <input class="form-check-input ms-2" value="man" type="radio" name="gender" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                ذكر
                                                            </label>
                                                        </div>
                                                        <div class="form-check d-flex justify-content-start mb-2">
                                                            <input class="form-check-input ms-2" value="female" type="radio" name="gender" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                انثى
                                                            </label>
                                                        </div>
                                                    </div>
                                              
                                                    @error('gender')
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
                                                    <button class="btn btn-success w-100" type="submit"> تسجيل الحساب  </button>
                                                </div>
                        
                                                <div class="mt-4 pt-2 text-center">
                                                    <div class="signin-other-title position-relative">
                                                        <h5 class="fs-sm mb-4 title"> انشاء حساب من </h5>
                                                    </div>
                                                    <div class="pt-2 hstack gap-2 justify-content-center">
                                                        {{-- <button type="button" class="btn btn-subtle-primary btn-icon"><i class="ri-facebook-fill fs-lg"></i></button> --}}
                                                        <a href="auth/google" class="btn btn-subtle-danger btn-icon"><i class="ri-google-fill fs-2"></i></a>
                                                        {{-- <button type="button" class="btn btn-subtle-dark btn-icon"><i class="ri-github-fill fs-lg"></i></button>
                                                        <button type="button" class="btn btn-subtle-info btn-icon"><i class="ri-twitter-fill fs-lg"></i></button> --}}
                                                    </div>
                                                </div>
                                            </form>
                        
                                            <div class="text-center mt-5">
                                                <p class="mb-0">  هل لديك حساب ? <a href="{{ route('login.index') }}" class="fw-semibold text-secondary text-decoration-underline"> تسجيل الدخول  </a> </p>
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