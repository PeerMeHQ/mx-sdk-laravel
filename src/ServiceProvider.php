<?php

namespace Peerme\Multiversx;

use Illuminate\Support\ServiceProvider as ServiceProviderBase;

class ServiceProvider extends ServiceProviderBase
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('elrond.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config.php',
            'elrond'
        );
    }
}
