@extends('layouts.app')

@section('title', 'Login - Carwash')
@section('breadcrumb_title', 'Login')

{{-- Hide the header top section --}}
@php
    $hideHeaderTop = true;
@endphp

@section('content')

    {{-- Login Form Area --}}
    <div class="login-area py-120">
        <div class="container">
            {{-- Your login form here --}}
        </div>
    </div>

@endsection
