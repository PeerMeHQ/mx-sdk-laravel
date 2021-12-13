<?php

namespace Superciety\ElrondSdk;

use Illuminate\Support\ServiceProvider as ServiceProviderBase;

class ServiceProvider extends ServiceProviderBase
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('elrond.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config.php',
            'elrond'
        );
    }
}
