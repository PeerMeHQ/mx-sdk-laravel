<?php

namespace Peerme\MxLaravel;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Peerme\Mx\Multiversx as MultiversxBase;
use Peerme\Mx\TokenPayment;
use Peerme\MxProviders\Api\ApiNetworkProvider;
use Peerme\MxProviders\ClientFactory;
use Peerme\MxProviders\NetworkProvider;

class Multiversx extends MultiversxBase
{
    public static function api(?ClientInterface $httpClient = null): ApiNetworkProvider
    {
        return NetworkProvider::api(config('multiversx.urls.api'), $httpClient);
    }

    public static function createMockedHttpClientWithResponse(array|string|int $value): ClientInterface
    {
        $libTestResponsesDir = 'vendor/peerme/mx-sdk-php-network-providers/tests/Api/responses';

        $resolveFilePath = fn (string $value) => file_get_contents(str_starts_with($value, '/')
            ? $value
            : base_path("{$libTestResponsesDir}/{$value}"));

        $contents = is_string($value) && str_ends_with($value, '.json')
            ? json_decode($resolveFilePath($value), true)
            : $value;

        $expectedResponse = new Response(200, [], $contents);
        $transactions = [];

        return ClientFactory::mock($expectedResponse, $transactions);
    }
}
