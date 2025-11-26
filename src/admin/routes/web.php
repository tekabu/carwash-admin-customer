<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTopUpController;
use App\Http\Controllers\CustomerTopUpPublicApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleTypePublicApiController;
use App\Http\Controllers\SoapTypeController;
use App\Http\Controllers\SoapTypePublicApiController;
use App\Http\Controllers\SalesReportController;

Route::get('api/vehicle-types', [VehicleTypePublicApiController::class, 'index'])->name('vehicle-types.api.index');
Route::get('api/soap-types', [SoapTypePublicApiController::class, 'index'])->name('soap-types.api.index');
Route::post('api/customer/{customer}/top-ups', [CustomerTopUpPublicApiController::class, 'store'])->name('customer-top-ups.api.store');

# on tap of rfid
Route::post('api/customer/rfid/{rfid}/check', [CustomerController::class, 'checkCustomerByRfid'])->name('customer.rfid.check');

Route::post('api/customer/{customer}/points/redeem', [CustomerController::class, 'redeemPoints'])->name('customer.points.redeem');

# before checkout
Route::post('api/customer/{customer}/balance/check', [CustomerController::class, 'checkBalance'])->name('customer.balance.check');

# after checkout, before starting cleaning
# no customer id in rest parameters, can be a guest
Route::post('api/customer/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
Route::post('api/customer/checkout/{reference}/success', [CustomerController::class, 'checkoutSuccess'])->name('customer.checkout.success');

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
    Route::resource('customer/top-ups', CustomerTopUpController::class)
        ->names('customer.top-ups');
    Route::resource('users', UserController::class);
    Route::resource('vehicle-types', VehicleTypeController::class);
    Route::resource('soap-types', SoapTypeController::class);
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
