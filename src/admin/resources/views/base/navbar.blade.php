<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0">
            <a href="{{ route('dashboard') }}" class="d-inline-flex align-items-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="" style="height: 2rem !important">
            </a>
        </div>

        <ul class="nav flex-row">

            <li class="nav-item nav-item-dropdown-lg dropdown">
            </li>

            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
            </li>
        </ul>

        <div class="navbar-collapse justify-content-center flex-lg-1 order-2 order-lg-1 collapse" id="navbar_search">

        </div>

        <ul class="nav flex-row justify-content-end order-1 order-lg-2">


            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                    <div class="status-indicator-container">
                        <img src="{{ asset('images/uni-user.png') }}" class="w-32px h-32px rounded-pill" alt="">
                        <span class="status-indicator bg-success"></span>
                    </div>
                    <span class="d-none d-lg-inline-block mx-lg-2">{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">

                    <!-- <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="ph-user-circle me-2"></i>
                        My Profile
                    </a> -->
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="ph-sign-out me-2"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->