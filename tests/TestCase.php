<?php

namespace Superciety\ElrondSdk\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as TestbenchCase;

class TestCase extends TestbenchCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Superciety\ElrondSdk\ServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('elrond.urls.api', 'https://some-non-existent-url-to-ensure-request-dont-hit-real-api.test');
    }
}
