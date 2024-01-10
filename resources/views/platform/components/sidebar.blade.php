

<style>
    .nav-link {
        font-size: 18px;
    }
</style>
       {{-- @if(!Auth::check())
       <div class='card d-none d-md-block'>
           <div class='card-body'>
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
                        <button class="btn btn-primary w-100" type="submit"> تسجيل الدخول </button>
                    </div>
                </form> 
           </div>
       </div>
        @endif --}}      
<nav id="sidebar" class="d-none d-md-block sidebar mb-3" style='background-color:#fff;width:100%;'>
    <div class="position-sticky p-0 border">
      <ul class="nav flex-column p-0">
        @include('platform.components.sidebar_links')
      </ul>

    </div>
  </nav>