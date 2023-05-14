<?php

namespace Aldijakaria\LaravelActivityLog\Providers;

use Aldijakaria\LaravelLogActivity\Middleware\TrackUserActivity;
use Illuminate\Support\ServiceProvider;

class LaravelActivityLogProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('track', TrackUserActivity::class);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-activity-log.php', 'laravel-activity-log'
        );
        $this->publishes([
            __DIR__.'/../config/laravel-activity-log.php' => config_path('laravel-activity-log.php'),
        ], 'config');
    }
}
