@extends('layouts.app')

@section('title', 'Register')
@section('breadcrumb_title', 'Register')

@section('content')



<div class="login-area py-120">
    <div class="container">
        <div class="col-md-5 mx-auto">
            <div class="login-form">

                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/my-account-logo.png') }}" alt="">
                    <p>Create your carwash account</p>
                </div>

                {{-- Backend validation (UNCHANGED) --}}
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

                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf

                    {{-- Full Name --}}
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control live-validate"
                               data-type="text"
                               data-name="Full Name"
                               placeholder="Your Name">
                        <div class="live-error"></div>
                    </div>

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

                  {{-- Phone --}}
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text"
                            name="phone"
                            class="form-control live-validate phone-only"
                            data-type="phone"
                            data-name="Phone Number"
                            placeholder="Your Phone Number"
                            inputmode="numeric"
                            maxlength="11">
                        <div class="live-error"></div>
                    </div>


                    {{-- Address --}}
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address"
                                  class="form-control live-validate"
                                  data-type="text"
                                  data-name="Address"
                                  rows="3"
                                  placeholder="Your Address"></textarea>
                        <div class="live-error"></div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control live-validate"
                               data-type="password"
                               data-name="Password"
                               placeholder="Your Password">
                        <div class="live-error"></div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control live-validate"
                               data-type="confirm"
                               data-name="Confirm Password"
                               placeholder="Confirm Your Password">
                        <div class="live-error"></div>
                    </div>

                    {{-- Terms --}}
                    <div class="form-check form-group">
                        <input class="form-check-input live-validate"
                               type="checkbox"
                               id="agree"
                               data-type="checkbox"
                               data-name="Terms of Service">
                        <label class="form-check-label" for="agree">
                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#tosModal">
                                Terms Of Service
                            </a>
                        </label>
                        <div class="live-error"></div>
                    </div>

                    <button type="submit" class="theme-btn w-100" id="registerBtn" disabled>
                        <i class="far fa-paper-plane"></i> Register
                    </button>
                </form>

                <div class="login-footer text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}">Login.</a></p>
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
    const submitBtn = document.getElementById('registerBtn');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

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
        const type = input.dataset.type;
        const value = input.value?.trim();

            if (type === 'checkbox') {
                if (!input.checked) {
                    showError(input, 'You must agree before registering');
                    return false;
                }
                showSuccess(input);
                return true;
            }

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

        if (type === 'phone') {
            if (value.length < 10) {
                showError(input, 'Phone number must be at least 10 digits');
                return false;
            }
        }

        if (type === 'password') {
            if (value.length < 8) {
                showError(input, 'Password must be at least 8 characters');
                return false;
            }
        }

        if (type === 'confirm') {
            if (value !== password.value) {
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
        input.addEventListener('change', checkForm);
        input.addEventListener('blur', checkForm);
    });

    // 🔢 Force numeric only for phone
    document.querySelectorAll('.phone-only').forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

});
</script>


@include('auth.tos')
@endpush
