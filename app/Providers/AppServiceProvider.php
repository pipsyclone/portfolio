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
        $this->app->singleton('app.setting', function () {
            return \App\Models\Setting::first();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Untuk Railway (public URL)
        // \URL::forceScheme('https');

        // Atau lebih spesifik
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }

        // Load Settings globally
        \View::composer('*', function ($view) {
            $setting = \App\Models\Setting::first();
            $view->with('appSetting', $setting);
        });
    }
}
