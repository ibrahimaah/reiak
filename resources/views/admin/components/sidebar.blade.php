<div class="app-menu navbar-menu" style="background-color: #fff;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="22">
            </span>
        </a>
        <a href="{{ route('admin.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="22">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" data-simplebar="init" class="h-100"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
  
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link active" href="{{ route('admin.index') }}">
                        <i class="ph-gauge"></i> <span data-key="t-dashboards">لوحة تحكم</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ph-layout"></i> <span data-key="t-layouts">الاستطلاعات</span>
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
                        <i class="mdi mdi-account-multiple"></i> <span data-key="t-layouts">المستخدمين</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link" data-key="t-horizontal">ادارة المستخدمين</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </div></div></div></div><div class="simplebar-placeholder" style="width: 249px; height: 337px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div><div class="simplebar-track simplebar-horizontal"><div class="simplebar-scrollbar"></div></div><div class="simplebar-track simplebar-vertical"><div class="simplebar-scrollbar"></div></div><div class="simplebar-track simplebar-horizontal"><div class="simplebar-scrollbar"></div></div><div class="simplebar-track simplebar-vertical"><div class="simplebar-scrollbar"></div></div><div class="simplebar-track simplebar-horizontal"><div class="simplebar-scrollbar"></div></div><div class="simplebar-track simplebar-vertical"><div class="simplebar-scrollbar"></div></div></ul>
        </div>
        <!-- Sidebar -->
    </div></div></div></div><div class="simplebar-placeholder" style="width: 249px; height: 337px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar simplebar-visible" style="height: 0px; transform: translate3d(0px, 16px, 0px); display: none;"></div></div></div>

    <div class="sidebar-background"></div>
</div>