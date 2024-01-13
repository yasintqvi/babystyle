<?php

use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Market\CheckoutController;
use App\Http\Controllers\Market\AddressController;
use App\Http\Controllers\Market\CommentController;
use App\Http\Controllers\Market\HomeController;
use App\Http\Controllers\Market\ShoppingCartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Market\ProductController as AppProductController;
use Illuminate\Support\Facades\Auth;
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

    // Auth::loginUsingId(1);
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

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses/store', [AddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/update/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/destroy/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('products', [AppProductController::class, 'index'])->name('products.index');
Route::get('products/{product:slug}', [AppProductController::class, 'show'])->name('products.show');
Route::post('products/get-price/{product}', [AppProductController::class, 'getPrice'])->name('products.get-price');
Route::post('comments/{product}', [CommentController::class, 'store'])->name('comments.store');

Route::prefix('shopping-cart')->middleware('auth')->as('shopping-cart.')->group(function() {
    Route::get('/', [ShoppingCartController::class, 'index'])->name('index');
    Route::delete('shopping-cart/{shoppingCartItem}', [ShoppingCartController::class, 'destroy'])->name('destroy');
    Route::post('/{product}', [ShoppingCartController::class, 'store'])->name('store');
    Route::post('/shopping-cart/{shoppingCartItem}/change-quantity', [ShoppingCartController::class, 'changeQuantity'])->name('change-quantity');
    Route::post('/shopping-cart/get-amounts', [ShoppingCartController::class, 'getAmounts'])->name('get-amounts');

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('check-shoppingcart');
});

Route::get('/get-province-cities-list' , [AddressController::class, 'getProvinceCitiesList']);
