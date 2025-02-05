<?php

namespace App\Providers;

use App\Services\ViewIntegrationService;
use Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ViewIntegrationService::class, function () {
            return new ViewIntegrationService;
        });
    }

    public function boot(): void
    {
        $configValues = [
            'app.name' => settings('internal.app.name', config('app.name')),
            'app.url' => settings('internal.app.url', config('app.url')),
            'app.timezone' => settings('internal.app.timezone', config('app.timezone')),
            'app.locale' => settings('internal.app.lang', config('app.locale')),
        ];

        if (! config('settings.disable_db_settings') && config('app.env') !== 'testing') {
            foreach ($configValues as $key => $value) {
                Config::set($key, $value);
            }
        }
    }
}
