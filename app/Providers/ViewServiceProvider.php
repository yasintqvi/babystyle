<?php

namespace App\Providers;

use App\Models\Market\Category;
use App\Models\Market\ShoppingCart;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('app.layouts.partials.header', function ($view) {
            
            $shoppingCartItemsCount = auth()->check() ? auth()->user()->shoppingCart()->first()->items->count() : 0;
            
            $categories = Category::where('is_active', 1)->where('show_in_menu', 1)->get();

            $view->with(
                [
                    'shoppingCartCount' => $shoppingCartItemsCount,
                    'categories' => $categories
                ]
            );
        });
    }
}
