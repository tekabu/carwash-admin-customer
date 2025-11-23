@extends('layouts.app')

@section('title', 'Register')

@section('breadcrumb_title', 'Register')

@section('content')

<!-- register area -->
<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">
                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
                    <p>Create your carwash account</p>
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

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Your Name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Your Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               placeholder="Your Phone Number" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Your Address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
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
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Confirm Your Password" required>
                    </div>
                    <div class="form-check form-group">
                        <input class="form-check-input" type="checkbox" value="" id="agree" required>
                        <label class="form-check-label" for="agree">
                            I agree with the <a href="#">Terms Of Service.</a>
                        </label>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> Register</button>
                    </div>
                </form>
                <div class="login-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Login.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register area end -->

@endsection
