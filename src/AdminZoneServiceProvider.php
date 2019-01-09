<?php

namespace Incraigulous\AdminZone;

use Illuminate\Support\ServiceProvider;

class AdminZoneServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        $this->publishes([
            __DIR__.'/../config/adminzone.php' => config_path('adminzone.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/adminzone'),
            __DIR__.'/../resources/assets' => resource_path('vendor/adminzone')
        ], 'assets');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'adminzone');
    }
}
