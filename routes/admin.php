<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\MenuController;
use App\Http\Controllers\Admin\Market\OnlinePaymentController;
use App\Http\Controllers\Admin\Market\PageController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DiscountCodeController;
use App\Http\Controllers\Admin\Market\FaqController;
use App\Http\Controllers\Admin\Market\ProductAttributeController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\ShippingMethodController;
use App\Http\Controllers\Admin\Market\SliderController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\User\ChangePasswordController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Market\ProductItemController;
use App\Http\Controllers\Admin\User\ProfileController;
use App\Http\Controllers\Admin\User\RoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', AdminDashboardController::class)->name('index');

  

    Route::prefix('user')->as('user.')->group(function () {
        Route::get('users/fetch', [UserController::class, "fetch"])->name('users.fetch');
        Route::post('change-password/{user}', ChangePasswordController::class)->name('change-password');
        Route::resource("users", UserController::class);

        Route::get('roles/fetch', [RoleController::class, "fetch"])->name('roles.fetch');
        Route::post('roles/batch-delete', [RoleController::class, "batchDelete"])->name('roles.batch-delete');
        Route::resource("roles", RoleController::class);
        
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('profile/security', [ProfileController::class, 'security'])->name('profile.security');
        Route::put('profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.image');
    });

    Route::prefix('market')->as('market.')->group(function () {

        Route::get('products/fetch', [ProductController::class, "fetch"])->name('products.fetch');
        Route::post('products/batch-delete', [ProductController::class, "batchDelete"])->name('products.batch-delete');
        Route::resource("products", ProductController::class)->except('show');
        Route::post('products/images/upload', [ProductController::class, "uploadImage"])->name('products.images.upload');
        Route::delete('products/images/{productImage}/destory', [ProductController::class, "destroyImage"])->name('products.images.destory');

        Route::resource('{product}/attributes', ProductAttributeController::class)->only('index' ,'destroy', 'store');
        Route::get('{product}/items/fetch', [ProductItemController::class, "fetch"])->name('items.fetch');
        Route::post('{productItem}/discount', [ProductItemController::class, 'storeDiscount'])->name('items.discount');
        Route::post('discounts/{productItemDiscount}/expiration', [ProductItemController::class, 'expiration'])->name('items.discount.expiration');
        Route::resource('{product}/items', ProductItemController::class)->except('show');

        Route::get('brands/fetch', [BrandController::class, "fetch"])->name('brands.fetch');
        Route::post('brands/batch-delete', [BrandController::class, "batchDelete"])->name('brands.batch-delete');
        Route::resource('brands', BrandController::class)->except('show');

        Route::get('categories/{category}/variations', [CategoryController::class, 'fetchVariations'])->name('categories.variations');
        Route::post('categories/batch-delete', [CategoryController::class, "batchDelete"])->name('categories.batch-delete');
        Route::get('categories/fetch', [CategoryController::class, "fetch"])->name('categories.fetch');
        Route::resource('categories', CategoryController::class)->except('show');
        
        Route::resource('menus', MenuController::class)->except('show');
        Route::get('menus/fetch', [MenuController::class, "fetch"])->name('menus.fetch');
        Route::post('menus/batch-delete', [MenuController::class, "batchDelete"])->name('menus.batch-delete');

        Route::post('sliders/batch-delete', [SliderController::class, "batchDelete"])->name('sliders.batch-delete');
        Route::get('sliders/fetch', [SliderController::class, "fetch"])->name('sliders.fetch');
        Route::resource('sliders', SliderController::class)->except('show');
       
        Route::post('pages/batch-delete', [PageController::class, "batchDelete"])->name('pages.batch-delete');
        Route::get('pages/fetch', [PageController::class, "fetch"])->name('pages.fetch');
        Route::resource('pages', PageController::class)->except('show');
        
        Route::post('faqs/batch-delete', [FaqController::class, "batchDelete"])->name('faqs.batch-delete');
        Route::get('faqs/fetch', [FaqController::class, "fetch"])->name('faqs.fetch');
        Route::resource('faqs', FaqController::class)->except('show');
        
        Route::post('comments/batch-delete', [CommentController::class, "batchDelete"])->name('comments.batch-delete');
        Route::get('comments/fetch', [CommentController::class, "fetch"])->name('comments.fetch');
        Route::get('comments/show', [CommentController::class, "show"])->name('comments.show');
        Route::resource('comments', CommentController::class);

          
        Route::post('shipping-methods/batch-delete', [ShippingMethodController::class, "batchDelete"])->name('shipping-methods.batch-delete');
        Route::get('shipping-methods/fetch', [ShippingMethodController::class, "fetch"])->name('shipping-methods.fetch');
        Route::resource('shipping-methods', ShippingMethodController::class)->except('show');

        Route::post('discount-codes/batch-delete', [DiscountCodeController::class, "batchDelete"])->name('discount-codes.batch-delete');
        Route::get('discount-codes/fetch', [DiscountCodeController::class, "fetch"])->name('discount-codes.fetch');
        Route::resource('discount-codes', DiscountCodeController::class);

        Route::get('/comments/{comment}/chang-approved' , [CommentController::class , 'changeApproved'])->name('comments.change-approved');

        Route::post('orders/{order}/change-status', [OrderController::class, "changeStatus"])->name('orders.change-status');
        Route::get('orders/fetch', [OrderController::class, "fetch"])->name('orders.fetch');
        Route::resource('orders', OrderController::class)->only('index', 'show');

        Route::get('online-payments/fetch', [OnlinePaymentController::class, "fetch"])->name('online-payments.fetch');
        Route::resource('online-payments', OnlinePaymentController::class)->only('index', 'show');

    });

});