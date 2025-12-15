<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerFeedbackController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [CustomerFeedbackController::class, 'store'])->name('contact.submit');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/history', [AuthController::class, 'history'])->name('history');
    Route::get('/top-up', [AuthController::class, 'topUp'])->name('top-up');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Example Routes - Demonstrating the Blade Template System
Route::prefix('examples')->group(function () {

    // Home page example
    Route::get('/home', function () {
        return view('examples.home_example');
    })->name('examples.home');

    // Standard page example with breadcrumb
    Route::get('/page', function () {
        return view('examples.page_example');
    })->name('examples.page');

    // Page with custom breadcrumb trail
    Route::get('/custom-breadcrumb', function () {
        return view('examples.page_with_custom_breadcrumb');
    })->name('examples.custom-breadcrumb');

    // Page without header top section
    Route::get('/no-header-top', function () {
        return view('examples.page_without_header_top');
    })->name('examples.no-header-top');

});
