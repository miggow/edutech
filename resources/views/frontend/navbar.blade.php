<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    style="margin: 0 !important; max-width: 100% !important; width: 100%;" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <a href="{{ url('/') }}" class="app-brand-link">

                <span class="app-brand-text demo menu-text fw-bolder ms-2">Edutech</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <li class="mx-3"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="mx-3"><a href="{{ route('FE.course') }}">Khóa học</a></li>
            <li class="mx-3"><a href="#">Giảng viên</a></li>
            <li class="mx-3"><a href="#">Về chúng tôi</a></li>
            <!-- User -->
            @if (Auth::check())
                <li class="nav-item navbar-dropdown dropdown-user dropdown">

                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset(auth()->user()->image) }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset(auth()->user()->image) }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                        {{-- <small class="text-muted">Admin</small> --}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Panel</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.settings') }}">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>

                </li>
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">
                    <i class='bx bx-log-in-circle'></i>
                    <span class="align-middle">Đăng nhập</span>
                </a>
            @endif

            <!--/ User -->
        </ul>
    </div>
</nav>
