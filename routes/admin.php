<?php

use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\SliderController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('/', fn() => view('admin.dashboard'));

    Route::prefix('market')->as('market.')->group(function () {
        Route::resource('brands', BrandController::class);
        Route::resource('sliders', SliderController::class);
    });

});