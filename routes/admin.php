<?php

use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\PageController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\FaqController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\ShippingMethodController;
use App\Http\Controllers\Admin\Market\SliderController;
use App\Http\Controllers\Admin\User\ChangePasswordController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Requests\Market\FaqRequest;
use App\Models\Market\shippingMethod;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('index');

    Route::prefix('user')->as('user.')->group(function () {
        Route::get('users/fetch', [UserController::class, "fetch"])->name('users.fetch');
        Route::post('change-password/{user}', ChangePasswordController::class)->name('change-password');
        Route::resource("users", UserController::class);
    });

    Route::prefix('market')->as('market.')->group(function () {

        Route::get('products/fetch', [ProductController::class, "fetch"])->name('products.fetch');
        Route::post('products/batch-delete', [ProductController::class, "batchDelete"])->name('products.batch-delete');
        Route::resource("products", ProductController::class);
        Route::post('products/images/upload', [ProductController::class, "uploadImage"])->name('products.images.upload');
        Route::post('products/images/destory', [ProductController::class, "destroyImage"])->name('products.images.destory');

        Route::get('brands/fetch', [BrandController::class, "fetch"])->name('brands.fetch');
        Route::post('brands/batch-delete', [BrandController::class, "batchDelete"])->name('brands.batch-delete');
        Route::resource('brands', BrandController::class);

        Route::post('categories/batch-delete', [CategoryController::class, "batchDelete"])->name('categories.batch-delete');
        Route::get('categories/fetch', [CategoryController::class, "fetch"])->name('categories.fetch');
        Route::get('/categories/{category}/find', [CategoryController::class, 'find'])->name('categories.find');
        Route::resource('categories', CategoryController::class);

        Route::post('sliders/batch-delete', [SliderController::class, "batchDelete"])->name('sliders.batch-delete');
        Route::get('sliders/fetch', [SliderController::class, "fetch"])->name('sliders.fetch');
        Route::resource('sliders', SliderController::class);
       
        Route::post('pages/batch-delete', [PageController::class, "batchDelete"])->name('pages.batch-delete');
        Route::get('pages/fetch', [PageController::class, "fetch"])->name('pages.fetch');
        Route::resource('pages', PageController::class);
        
        Route::post('faqs/batch-delete', [FaqController::class, "batchDelete"])->name('faqs.batch-delete');
        Route::get('faqs/fetch', [FaqController::class, "fetch"])->name('faqs.fetch');
        Route::resource('faqs', FaqController::class);
        
        Route::post('comments/batch-delete', [CommentController::class, "batchDelete"])->name('comments.batch-delete');
        Route::get('comments/fetch', [CommentController::class, "fetch"])->name('comments.fetch');
        Route::resource('comments', CommentController::class);

          
        Route::post('comments/batch-delete', [ShippingMethodController::class, "batchDelete"])->name('shipping-methods.batch-delete');
        Route::get('shipping-methods/fetch', [ShippingMethodController::class, "fetch"])->name('shipping-methods.fetch');
        Route::resource('shipping-methods', ShippingMethodController::class);


        //تغیر تایید و عدم تایید کامنت
        Route::get('/comments/{comment}/chang-approved' , [CommentController::class , 'changeApproved'])->name('comments.change-approved');
    });

});