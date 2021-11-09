<?php

use Illuminate\Support\Facades\Http;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

uses(\Superciety\ElrondSdk\Tests\TestCase::class)->in(__DIR__);
uses(\Spatie\Snapshots\MatchesSnapshots::class)->in(__DIR__);

function fakeApiRequestWithResponse(string $endpoint, string $responseFile): void
{
    $response = file_get_contents(__DIR__ . '/Api/responses/' . $responseFile);

    Http::fake([
        config('elrond.urls.api') . '/' . ltrim($endpoint, '/') => Http::response($response),
    ]);
}

function assertMatchesResponseSnapshot($actual): void
{
    test()->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
}
