<?php

namespace App\Providers;

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
            
            $view->with(
                [
                    'shoppingCartCount' => $shoppingCartItemsCount,
                ]
            );
        });
    }
}
