<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('base.head')

<body>
    @include('base.navbar')

    <!-- Page content -->
    <div class="page-content">
        @include('base.sidebar')

        @yield('main-content')
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                    @section('header')
                    <!-- Page header -->
                    <div class="page-header page-header-light shadow">
                        <div class="page-header-content d-lg-flex">
                            @section('header-content')
                            <div class="d-flex">
                                <h4 class="page-title mb-0">
                                    @yield('header_title')
                                    @show
                                </h4>
                            </div>
                            @yield('header_right')
                            @show
                        </div>
                    </div>
                    <!-- /page header -->
                    @show

                @section('content-area')
                <!-- Content area -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- /content area -->
                @show
                
                @section('footer')
                    @include('base.footer')
                @show
            </div>
            <!-- /inner content -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    @yield('scripts')
</body>
</html>
