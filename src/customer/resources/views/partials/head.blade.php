<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="@yield('meta_description', '')">
<meta name="keywords" content="@yield('meta_keywords', '')">

<title>@yield('title', 'Carwash - Car Washing Services')</title>

<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/favicon.png') }}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/all-fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@stack('styles')
