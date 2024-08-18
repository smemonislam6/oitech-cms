<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ route('admin.dashboard') }}" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="small logo">
                    </span>
                </a>

                 <!-- Brand Logo Dark -->
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="small logo">
                    </span>
                </a>
                <button class="button-toggle-menu">
                    <i class="ri-menu-line"></i>
                </button>
            </div>

        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line fs-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            {{-- <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">

                    <span class="align-middle d-none d-lg-inline-block">English</span> <i
                        class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                    <!-- item-->
                    @foreach (get_all_language() as $item)
                        <a href="javascript:void(0);" class="dropdown-item">
                            <span class="align-middle">{{ $item->name }}</span>
                        </a>
                    @endforeach
                </div>
            </li> --}}

            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line fs-22"></i>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ asset(Auth::guard('admin')->user()->ProfileImageUrl) }}" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-block d-none">
                        <h5 class="my-0 fw-normal">{{ Auth::guard('admin')->user()->name }} <i class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"></h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin.profile.update') }}" class="dropdown-item">
                        <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                        <span >{{ __('Edit Profile') }}</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('admin.password.change') }}" class="dropdown-item">
                        <i class="ri-settings-4-line fs-18 align-middle me-1"></i>
                        <span >{{ __('Password Change') }}</span>
                    </a>

                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
