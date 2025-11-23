<header class="@yield('header_class', 'header')">
    @if(!isset($hideHeaderTop) || !$hideHeaderTop)
        @include('partials.header-top')
    @endif
    @include('partials.navigation')
</header>
