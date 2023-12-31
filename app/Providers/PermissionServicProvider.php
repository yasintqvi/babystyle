<?php

namespace App\Providers;

use App\Models\User\Permission;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServicProvider extends ServiceProvider
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
     *
     * @return void
     */
    public function boot()
    {
        try {
            Permission::get()->map(function ($permission) {
            Gate::define($permission->key, function ($user) use ($permission){
                    return $user->is_admin ? true : $user->hasPermissionTo($permission);
                });
            });

        } catch (Exception $e) {
            report($e);
            return false;
        }
    }
}
