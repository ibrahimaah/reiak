<header id="page-topbar" class="topbar-shadow" style="background-color: #fff;">
    
    <div class="layout-width">
        <div class="navbar-header">
  <div class="bi h1 bi-list d-block d-md-none"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> خيارات </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link active" href="{{ route('admin.index') }}">
                        <i class="ph-gauge me-2"></i> <span data-key="t-dashboards">لوحة تحكم</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ph-layout me-2"></i> <span data-key="t-layouts">الاستطلاعات</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('vote.index') }}" class="nav-link" data-key="t-horizontal"> تفقد الاستطلاعات  </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarLayouts3" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="mdi mdi-account-multiple me-2"></i> <span  data-key="t-layouts">المستخدمين</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link" data-key="t-horizontal">ادارة المستخدمين</a>
                            </li>
                        </ul>
                    </div>
                </li>
                  <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button class="btn btn-light my-2 ms-2"> 
                    <i class="bi bi-box-arrow-right"></i>
                      <span class="me-2"> تسجيل الخروج </span>
                  </button>
                </form>
        </ul>
      
    </div>

  </div>
</div>
            <div class="d-flex">
                <!-- LOGO -->
              


            </div>

            <div class="d-flex align-items-center">

             

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-md-inline-block ms-1 h5 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        
                   
                      
                        <div class="dropdown-divider"></div>
                   
                        <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                        <button class="dropdown-item" type="submit"><i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>