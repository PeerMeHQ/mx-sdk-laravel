<?php

use Illuminate\Support\Facades\Http;
use Peerme\Multiversx\Tests\TestCase;
use Peerme\Multiversx\Tests\ResponseSnapshotDriver;

uses(TestCase::class)->in(__DIR__);

function fakeApiRequestWithResponse(string $endpoint, string $responseFile): void
{
    $response = file_get_contents(__DIR__ . '/Api/responses/' . $responseFile);

    Http::fake([
        config('elrond.urls.api') . '/' . ltrim($endpoint, '/') => Http::response($response),
    ]);
}

function fakeApiRequestWithResponseValue(string $endpoint, $value): void
{
    Http::fake([
        config('elrond.urls.api') . '/' . ltrim($endpoint, '/') => Http::response($value),
    ]);
}

function assertMatchesResponseSnapshot($actual): void
{
    test()->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
}
