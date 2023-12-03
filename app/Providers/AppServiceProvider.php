<?php

namespace App\Providers;

use App\Models\Market\Comment;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
        view()->composer('admin.layouts.partials.sidebar', function ($view){
            $view->with('comments', Comment::where('is_seen', 0)->get());
        });
    }
}
