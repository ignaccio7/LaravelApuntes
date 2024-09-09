<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// importamos esta clase para la paginacion
//use Illuminate\Pagination\Paginator;

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
        // Para usar la paginacion con bootstrap
        //Paginator::useBootstrap();
    }
}
