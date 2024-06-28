<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsUserVerifyEmail;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User/Auth/login');
});

// Admin routes
Route::prefix('/admin')->namespace('App\Http\Controllers')->group(function () {
    Route::match(['get', 'post'], 'login', 'Admin\AdminController@Login');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('dashboard', 'Admin\AdminController@Dashboard');
        Route::get('logout', 'Admin\AdminController@Logout');
        Route::resource('categorycar', 'CategoryCar\CategoryCarController');
        Route::resource('car', 'Car\CarController');
        Route::resource('plugs', 'Plug\PlugController');
        Route::resource('voltages', 'Voltage\VoltageController');
        Route::resource('capacities', 'Capacity\CapacityController');
        Route::resource('customers', 'Customer\CustomerController');

    });
});

// User routes
Route::prefix('/user')->namespace('App\Http\Controllers')->group(function () {
    Route::get('/verify', 'User\UserController@Verify')->name('user.verify');
    Route::match(['get', 'post'], 'login', 'User\UserController@Login');
    Route::match(['get', 'post'], 'register', 'User\UserController@Register');
    Route::match(['get', 'post'], 'form-validation', 'User\UserController@FormValidation');
    Route::match(['get', 'post'], 'form-verification-code', 'User\UserController@VerificationCode');
    Route::match(['get', 'post'], 'reset-password', 'User\UserController@ResetPassword');

    Route::middleware([UserMiddleware::class, IsUserVerifyEmail::class])->group(function () {
        Route::get('dashboard', 'User\UserController@Dashboard');
        Route::get('cs', 'ChargingSession\ChargingSessionController@Index');
        Route::post('create-charge', 'ChargingSession\ChargingSessionController@CreateCharging')->name('cs.create');
        Route::get('logout', 'User\UserController@Logout');
        Route::get('mycharge', 'User\UserController@MyCharging');
        Route::delete('cancelcharging/{id}', 'User\UserController@CancelCharging')->name('cancel');

    });
});
