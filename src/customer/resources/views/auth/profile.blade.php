@extends('layouts.app')

@section('title', 'Profile')

@section('breadcrumb_title', 'My Profile')

@section('content')

<!-- profile area -->
<div class="login-area py-120">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="login-form">
                    <div class="login-header">
                        <h2>My Profile</h2>
                        <p>Manage your account information</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Update Profile Form -->
                    <div class="login-form">
                        <form action="{{ route('profile.update') }}" method="POST" class="mb-4">
                            @csrf
                            @method('PUT')

                            <div class="profile-info mb-4">
                                <h5>Account Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Name:</strong></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"><strong>Email:</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Member Since:</strong></label>
                                            <p class="form-control-plaintext">{{ Auth::user()->created_at->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Form -->
                    <div class="login-form mt-4">
                        <form action="{{ route('password.change') }}" method="POST" class="mb-4">
                            @csrf
                            @method('PUT')

                            <div class="profile-info mb-4">
                                <h5>Change Password</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="current_password"><strong>Current Password:</strong></label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                   id="current_password" name="current_password" required>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password"><strong>New Password:</strong></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Minimum 8 characters</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation"><strong>Confirm New Password:</strong></label>
                                            <input type="password" class="form-control"
                                                   id="password_confirmation" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-warning">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if(Auth::user()->customer)
                    <div class="profile-info mb-4">
                        <h5>Customer Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Balance:</strong></label>
                                    <p class="text-success">₱{{ number_format(Auth::user()->customer->balance ?? 0, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Points:</strong></label>
                                    <p class="text-primary">{{ number_format(Auth::user()->customer->points ?? 0) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- profile area end -->

@endsection
