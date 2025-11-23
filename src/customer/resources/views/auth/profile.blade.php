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

                    <div class="profile-info mb-4">
                        <h5>Account Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Name:</strong></label>
                                    <p>{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Email:</strong></label>
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Member Since:</strong></label>
                                    <p>{{ Auth::user()->created_at->format('F d, Y') }}</p>
                                </div>
                            </div>
                        </div>
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
