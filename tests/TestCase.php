<?php

namespace Superciety\ElrondSdk\Tests;

use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function fakeHttpWithResponse(string $endpoint, string $responseFile): void
    {
        $response = file_get_contents(__DIR__ . '/responses/' . $responseFile);

        Http::fake([
            'api.elrond.com/' . ltrim($endpoint, '/') => Http::response($response),
        ]);
    }
}
