<?php

use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Market\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// auth routes
Route::middleware('guest')->group(function () {

    Route::get('login', [LoginRegisterController::class, 'form'])->name('login.form');

    Route::post('login/check', [LoginRegisterController::class, 'check'])->name('login.check');

    Route::get('login/otp', [OtpController::class, 'show'])->name("login.otp.show");
    Route::post('login/otp', [OtpController::class, 'login'])->name("login.otp");
    Route::post('login/otp/resend', [OtpController::class, 'resend'])->name("login.otp.resend");

    Route::get('login/password', [PasswordController::class, 'show'])->name("login.password.show");
    Route::post('login/password', [PasswordController::class, 'login'])->name("login.password");
});

Route::prefix('forgot-password')->as('forgot.')->group(function() {
    Route::get('/', [ForgotPasswordController::class, 'show'])->name('show');
    Route::post('/', [ForgotPasswordController::class, 'check'])->name('check');
});

Route::middleware('auth')->group(function () {

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [LoginRegisterController::class, 'logout'])
        ->name('logout');

});

Route::prefix('profile')->middleware('auth')->as('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('products/{category:slug?}', [ProductController::class, 'index'])->name('products.index');