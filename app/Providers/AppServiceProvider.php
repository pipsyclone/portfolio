<?php

namespace App\Providers;

use App\Services\CloudinaryStorageAdapter;
use Cloudinary\Cloudinary;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // JANGAN akses database di register()
        $this->app->singleton('app.setting', function () {
            // Defer loading sampai benar-benar diperlukan
            return function () {
                return Cache::remember('app_setting', 3600, function () {
                    return \App\Models\Setting::first() ?? new \App\Models\Setting;
                });
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Override Cloudinary disk dengan custom adapter yang tidak memanggil Admin API untuk getUrl
        Storage::extend('cloudinary', function ($app, $config) {
            $cloudinary = new Cloudinary($config['url']);
            $adapter = new CloudinaryStorageAdapter($cloudinary, null, $config['prefix'] ?? null);
            
            return new FilesystemAdapter(new Filesystem($adapter, $config), $adapter, $config);
        });

        // Force HTTPS di production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // View composer dengan cache dan error handling
        View::composer('*', function ($view) {
            try {
                // Gunakan cache untuk mencegah query berulang
                $setting = Cache::remember('global_setting', 3600, function () {
                    return \App\Models\Setting::first() ?? new \App\Models\Setting;
                });

                $view->with('appSetting', $setting);
            } catch (\Exception $e) {
                // Jika database belum siap, berikan empty setting
                $view->with('appSetting', new \App\Models\Setting);
            }
        });
    }
}
