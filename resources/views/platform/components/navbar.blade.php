


<nav class="navbar navbar-expand-sm py-3 d-lg-block d-none bg-light shadow">
  <div class="container">
  <a class="navbar-brand" href="/">
    <img src="{{ asset('assets/images/logo/logo.png') }}" style="width:70px"/>
  </a>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

    </ul>
    <ul class="navbar-nav me-auto  mb-2 mb-lg-0">
      <li class="nav-item ms-3">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="ابحث" style="width: 300px;" aria-label="Search">
          <button class="btn btn-success mx-2" type="submit"> بحث </button>
        </form>
      </li>
      <li  class="m-0 p-0 d-flex align-items-center">
        @if (Auth::check())
            <div class="dropdown">
              <a href="#" class="btn btn-light dropdown text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                {{ Auth::user()->name }} 
              </a>
              <div class="dropdown-menu">
                     @if(Auth::user()->role === 'admin')

                    <a href='{{route('admin.index')}}' class="dropdown-item btn h6 d-flex align-items-center text-end"> 
                   
                      <span class="me-2 text-secondary"> لوحة تحكم المدير  </span>
                     </a>
                        @endif
                <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button class="dropdown-item btn h6 d-flex align-items-center text-end"> 
                    <i class="bi bi-box-arrow-right"></i>
                      <span class="me-2 text-secondary"> تسجيل الخروج </span>
                  </button>
                </form>
              </div>
          </div>
        @else
        <div class="dropdown">
          <a  href="#" class="btn btn-light dropdown text-secondary" data-bs-toggle="dropdown" aria-expanded="false"> حساب  زائر   </a>
            <div class="dropdown-menu">
                <a href="{{ route('login.index') }}" class="dropdown-item btn h6 d-flex align-items-center text-end"> 
                  <i class="bi bi-box-arrow-in-left"></i>
                    <span class="me-2 text-secondary">   تسجيل الدخول  </span>
                </a>
                <a href="{{ route('register.index') }}" class="dropdown-item btn h6 d-flex align-items-center text-end"> 
                  <i class="bi bi-person-plus-fill"></i>
                    <span class="me-2 text-secondary">  انشاء حساب </span>
                </a>
            </div>
        </div>
           
        @endif
      </li>
    </ul>

            

  </div>
</nav>

<div style="background-color: #fff;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;" 
     class="d-lg-none d-block">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a class="navbar-brand text-success" href="/">
        <img src="{{ asset('assets/images/logo/logo.png') }}" style="width:100px"/>
        </a>

        <!-- Base Examples -->
        <div class="hstack flex-wrap gap-2 m-0 p-0">
            
            <a class="btn p-0 m-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <div class="bi h2 bi-list"></div>
            </a>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title m-auto" id="offcanvasExampleLabel">
                  <img src="{{ asset('assets/images/logo/logo.png') }}" style="width:100px"/>
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                   @auth
                 <h6 class="me-3 text-secondary" id="offcanvasExampleLabel"> المستخدم :  {{Auth::user()->name}} </h6>
                 <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button class="btn btn-light my-2 me-3"> 
                    <i class="bi bi-box-arrow-right"></i>
                      <span class="me-2 text-secondary"> تسجيل الخروج </span>
                  </button>
                </form>
                 @endauth
              <ul class="nav flex-column mb-3 p-0">
                  @include('platform.components.sidebar_links')
              </ul>
        {{-- @if(!Auth::check())
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
                        <label for="username" class="form-label">الايميل <span class="text-danger">*</span></label>
                        <div class="position-relative ">
                            <input type="text" class="form-control pe-2 password-input" id="username" name="email" placeholder=" أدخل الايميل " required="">
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password-input">كلمة المرور <span class="text-danger">*</span></label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-2 password-input " name="password" placeholder=" أدخل كلمة السر " id="password-input" required="">
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit"> تسجيل الدخول </button>
                    </div>
                    <div class="mt-4">
                       <span> لا تملك حساب ?  <a href="{{route('register.index')}}"> انشاء حساب </a> </span>
                    </div>
                </form> 
             @endif --}}
            </div>
        </div>
    </div>
</div>
