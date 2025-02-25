<?php

namespace App\Providers;

use App\Models\Factura;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('ver-factura', function (User $user, Factura $factura) {
            return $factura->user_id === $user->id;
        });
    }
}
