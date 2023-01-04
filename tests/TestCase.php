<?php

namespace Peerme\MxLaravel\Tests;

use Orchestra\Testbench\TestCase as TestbenchCase;

class TestCase extends TestbenchCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Peerme\MxLaravel\ServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
