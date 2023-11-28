<?php

namespace MultiversX\Tests;

use Orchestra\Testbench\TestCase as TestbenchCase;

class TestCase extends TestbenchCase
{
    protected function getPackageProviders($app)
    {
        return [
            \MultiversX\ServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
