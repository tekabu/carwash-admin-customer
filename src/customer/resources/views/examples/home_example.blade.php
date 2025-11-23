@extends('layouts.home')

@section('title', 'Home - Carwash')

@section('main_class', 'home-3 main')
@section('header_class', 'home-3 header')
@section('footer_class', 'home-3 footer-area')

@section('content')

    {{-- Hero Slider Section --}}
    <div class="hero-section">
        {{-- Your hero slider content here --}}
    </div>

    {{-- About Area --}}
    <div class="about-area py-120 mb-50">
        {{-- Your about content here --}}
    </div>

    {{-- More sections... --}}

@endsection

@push('styles')
    {{-- Additional page-specific styles if needed --}}
@endpush

@push('scripts')
    {{-- Additional page-specific scripts if needed --}}
@endpush
