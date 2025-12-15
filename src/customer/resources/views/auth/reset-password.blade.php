@extends('layouts.app')

@section('title', 'Reset Password')
@section('breadcrumb_title', 'Reset Password')

@section('content')

<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">

                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/my-account-logo.png') }}" alt="">
                    <p>Enter your new password</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password"
                               name="password"
                               class="form-control live-validate"
                               data-type="password"
                               data-name="Password"
                               placeholder="New Password">
                        <div class="live-error"></div>
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control live-validate"
                               data-type="password_confirmation"
                               data-name="Confirm Password"
                               placeholder="Confirm New Password">
                        <div class="live-error"></div>
                    </div>

                    <button type="submit" class="theme-btn w-100" id="submitBtn" disabled>
                        <i class="far fa-lock"></i> Reset Password
                    </button>
                </form>

                <div class="login-footer text-center mt-3">
                    <p>Remember your password? <a href="{{ route('login') }}">Login.</a></p>
                </div>

            </div>
        </div>
    </div>
</div>

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
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');

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

        if (type === 'password') {
            if (value.length < 8) {
                showError(input, 'Password must be at least 8 characters');
                return false;
            }
        }

        if (type === 'password_confirmation') {
            const password = passwordInput.value;
            if (value !== password) {
                showError(input, 'Passwords do not match');
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
