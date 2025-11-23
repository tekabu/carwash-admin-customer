<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body>

    @include('partials.preloader')

    @include('partials.header')

    @include('partials.search-popup')

    <main class="@yield('main_class', 'main')">
        @if(!isset($hideBreadcrumb) || !$hideBreadcrumb)
            @include('partials.breadcrumb')
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.scroll-top')

    @include('partials.scripts')

</body>
</html>
