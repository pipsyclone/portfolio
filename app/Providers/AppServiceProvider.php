<?php

namespace App\Providers;

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
        // Untuk Railway (public URL)
        \URL::forceScheme('https');

        // Atau lebih spesifik
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
