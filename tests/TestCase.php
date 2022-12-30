<?php

namespace Peerme\Multiversx\Tests;

use Illuminate\Support\Facades\Config;
use Spatie\Snapshots\MatchesSnapshots;
use Orchestra\Testbench\TestCase as TestbenchCase;

class TestCase extends TestbenchCase
{
    use MatchesSnapshots;

    protected function getPackageProviders($app)
    {
        return [
            \Peerme\Multiversx\ServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('elrond.urls.api', 'https://some-non-existent-url-to-ensure-request-dont-hit-real-api.test');
    }

    protected function getSnapshotDirectory(): string
    {
        return __DIR__ . '/__snapshots__';
    }
}
