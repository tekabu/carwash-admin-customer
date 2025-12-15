@extends('layouts.app')

@section('title', 'Login')
@section('breadcrumb_title', 'Login')

@section('content')

<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">

                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/my-account-logo.png') }}" alt="">
                    <p>Login with your carwash account</p>
                </div>

                {{-- BACKEND ERRORS (UNCHANGED) --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- BACKEND SUCCESS (UNCHANGED) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control live-validate"
                               data-type="email"
                               data-name="Email Address"
                               placeholder="Your Email">
                        <div class="live-error"></div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="form-control live-validate"
                               data-type="password"
                               data-name="Password"
                               placeholder="Your Password">
                        <div class="live-error"></div>
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

                    <button type="submit" class="theme-btn w-100" id="loginBtn" disabled>
                        <i class="far fa-sign-in"></i> Login
                    </button>
                </form>

                <div class="login-footer text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register.</a></p>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Preloader --}}
<div class="preloader" style="display:none;">
    <div class="loader-ripple">
        <div></div>
        <div></div>
    </div>
</div>

{{-- SUCCESS MODAL (UNCHANGED) --}}
@if (session('success'))
<div class="modal fade" id="loginSuccessModal" tabindex="-1">
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

@endsection

@push('styles')
<style>
.form-control.is-invalid-live {
    border-color: #dc3545;
}
.form-control.is-valid-live {
    border-color: #28a745;
}
.live-error {
    font-size: 0.85rem;
    color: #dc3545;
    display: none;
    margin-top: 4px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputs = document.querySelectorAll('.live-validate');
    const submitBtn = document.getElementById('loginBtn');

    function showError(input, message) {
        const error = input.parentElement.querySelector('.live-error');
        input.classList.add('is-invalid-live');
        input.classList.remove('is-valid-live');
        error.innerText = message;
        error.style.display = 'block';
    }

    function showSuccess(input) {
        const error = input.parentElement.querySelector('.live-error');
        input.classList.remove('is-invalid-live');
        input.classList.add('is-valid-live');
        error.style.display = 'none';
    }

    function validateField(input) {
        const value = input.value.trim();
        const type = input.dataset.type;

        if (!value) {
            showError(input, input.dataset.name + ' is required');
            return false;
        }

        if (type === 'email') {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(value)) {
                showError(input, 'Invalid email format');
                return false;
            }
        }

        showSuccess(input);
        return true;
    }

    function checkForm() {
        let valid = true;
        inputs.forEach(input => {
            if (!validateField(input)) valid = false;
        });
        submitBtn.disabled = !valid;
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkForm);
        input.addEventListener('blur', checkForm);
    });

});
</script>
@endpush
