<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    @stack('styles')

    @stack('head_js')

    <!-- Theme JS files -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
