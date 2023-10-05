<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsNotAuthenticated;
use App\Http\Middleware\IsVerified;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::middleware(IsNotAuthenticated::class)->group(function () {
        Route::get('register', 'register')->name('auth.register');
        Route::post('register', 'store')->name('auth.store');

        Route::get('login', 'login')->name('auth.login');
        Route::post('login', 'check')->name('auth.check');
    });

    Route::middleware(IsAuthenticated::class)->group(function () {
        Route::post('logout', 'logout')->name('auth.logout');

        Route::middleware(IsVerified::class)->group(function () {
            Route::get('/password-change', 'changePassword')->name('auth.passwordChange');
            Route::post('/password-change', 'changePasswordStore')->name('auth.passwordChangeStore');
        });

        Route::get('/email-verify', 'verify')->name('auth.verify');
        Route::post('/email-verify', 'verifyStore')->name('auth.verifyStore');
    });
});

Route::controller(HomeController::class)
    ->prefix('dashboard')
    ->group(function () {
        Route::middleware(IsAuthenticated::class)->group(function () {
            Route::get('home', 'home')->name('dashboard.home');
        });
    });
