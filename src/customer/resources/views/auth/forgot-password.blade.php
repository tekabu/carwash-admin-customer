@extends('layouts.app')

@section('title', 'Forgot Password')
@section('breadcrumb_title', 'Forgot Password')

@section('content')

<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">

                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/my-account-logo.png') }}" alt="">
                    <p>Enter your email to reset your password</p>
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

                <form action="{{ route('password.email') }}" method="POST" id="forgotPasswordForm">
                    @csrf

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control live-validate"
                               data-type="email"
                               data-name="Email Address"
                               placeholder="Your Email"
                               value="{{ old('email') }}">
                        <div class="live-error"></div>
                    </div>

                    <button type="submit" class="theme-btn w-100" id="submitBtn" disabled>
                        <i class="far fa-paper-plane"></i> Send Reset Link
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
