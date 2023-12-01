<?php

use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\PageController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\FaqController;
use App\Http\Controllers\Admin\Market\SliderController;
use App\Http\Requests\Market\FaqRequest;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('/', fn() => view('admin.dashboard'))->name('index');

    Route::prefix('market')->as('market.')->group(function () {
        Route::resource('brands', BrandController::class);
        Route::get('/categories/fetch', [CategoryController::class, "fetch"])->name('categories.fetch');
        Route::resource('categories', CategoryController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('pages', PageController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('comments', CommentController::class);


        //تغیر تایید و عدم تایید کامنت
        Route::get('/comments/{comment}/chang-approved' , [CommentController::class , 'changeApproved'])->name('comments.change-approved');
    });

});