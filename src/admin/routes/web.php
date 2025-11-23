<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTopUpController;
use App\Http\Controllers\CustomerTopUpPublicApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\PackageTypeController;
use App\Http\Controllers\SalesReportController;

Route::post('api/customer-top-ups', [CustomerTopUpPublicApiController::class, 'store'])->name('customer-top-ups.api.store');

Route::get('login', [AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard');
    });

    Route::resource('customers', CustomerController::class);
    Route::get('customers/{customer}/add-balance', [CustomerController::class, 'showAddBalanceForm'])->name('customers.showAddBalanceForm');
    Route::post('customers/{customer}/add-balance', [CustomerController::class, 'addBalance'])->name('customers.addBalance');
    Route::resource('customer-top-ups', CustomerTopUpController::class);
    Route::resource('users', UserController::class);
    Route::resource('vehicle-types', VehicleTypeController::class);
    Route::resource('package-types', PackageTypeController::class);
    Route::get('sales-reports', [SalesReportController::class, 'index'])->name('sales-reports.index');
});

// Route::middleware(['guest'])->group(function () {
//     Route::get('login', [LoginController::class, 'index'])->name('login');

//     Route::prefix('login')
//     ->name('login.')
//     ->group(function ()
//     {    
//         Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
//         Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
//         Route::get('/test', [LoginController::class, 'test'])->name('test');
//     });
// });

Route::get('/profile', function ()
{
    return '';
})->name('profile');
