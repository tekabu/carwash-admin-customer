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
                    <img src="{{ asset('assets/img/logo/my-account-logo.png') }}" alt="">
                    <p>Login with your carwash account</p>
                </div>

                {{-- ERROR ALERT --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- SUCCESS ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

{{-- Preloader --}}
<div class="preloader" style="display:none;">
    <div class="loader-ripple">
        <div></div>
        <div></div>
    </div>
</div>


<!-- ✔️ SUCCESS LOGIN MODAL -->
@if (session('success'))
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">

            <div class="text-success" style="font-size: 60px;">
                <i class="fas fa-check-circle"></i>
            </div>

            <h4 class="mt-3 mb-2">Login Successful!</h4>
            <p>You have logged in successfully.</p>

        </div>
    </div>
</div>
@endif


{{-- Alert + Preloader + Modal Script --}}
<script>
document.addEventListener("DOMContentLoaded", function() {

    // Ensure alerts appear above preloader
    var alerts = document.querySelectorAll('#successAlert, #errorAlert');
    alerts.forEach(function(alert) {
        if (alert) alert.style.zIndex = 10000;
    });

    // Auto-dismiss alerts
    function autoDismiss(alertId, timeout) {
        var alert = document.getElementById(alertId);
        if (alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, timeout);
        }
    }

    autoDismiss('successAlert', 3000);
    autoDismiss('errorAlert', 5000);

    // Show preloader after short delay
    setTimeout(function() {
        var preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.style.display = 'block';
        }
    }, 500);

    // ✔️ Show Success Modal if login is successful
    @if (session('success'))
        var loginModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
        loginModal.show();

        // Auto close modal after 2 seconds, then redirect to dashboard
        setTimeout(() => {
            loginModal.hide();
            window.location.href = "{{ route('dashboard') }}";
        }, 2000);
    @endif

});
</script>

@endsection
