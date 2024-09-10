<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
    public function boot()
    {
        // Blade::if('role', function ($role) {
        //     return auth()->check() && auth()->user()->hasRole($role);
        // });

        // Blade::if('can', function ($permission) {
        //     return auth()->check() && auth()->user()->can($permission);
        // });
    }
}
