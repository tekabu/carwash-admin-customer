<div class="main-navigation">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo/ck-logo.png') }}" alt="logo">
            </a>
            <div class="mobile-menu-right">
                <div class="mobile-menu-list">
                    <a href="#" class="mobile-menu-link search-box-outer"><i class="far fa-search"></i></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="far fa-stream"></i></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ url('about-us') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="{{ url('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('contact') }}">Contact</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link {{ request()->is('history') ? 'active' : '' }}" href="{{ route('history') }}">History</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('top-up') ? 'active' : '' }}" href="{{ route('top-up') }}">Top Up</a></li>
                    @endauth
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                My Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('profile') ? 'active' : '' }}" href="#" id="myAccountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                My Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="myAccountDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>