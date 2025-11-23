@extends('layouts.app')

@section('title', 'Login')

@section('breadcrumb_title', 'Login')

@section('content')

<!-- login area -->
<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">
                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
                    <p>Login with your carwash account</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Your Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Your Password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <a href="#" class="forgot-pass">Forgot Password?</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                    </div>
                </form>
                <div class="login-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->

@endsection
