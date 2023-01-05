<?php

namespace Peerme\MxLaravel;

use Carbon\Carbon;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Peerme\Mx\Multiversx as MultiversxBase;
use Peerme\MxProviders\Api\ApiNetworkProvider;
use Peerme\MxProviders\ClientFactory;
use Peerme\MxProviders\NetworkProvider;

class Multiversx extends MultiversxBase
{
    private const HttpClientContainerAbstract = 'mx_http_client';

    public static function api(?ClientInterface $httpClient = null): ApiNetworkProvider
    {
        $injectedClient = app()->bound(static::HttpClientContainerAbstract) ? app(static::HttpClientContainerAbstract) : null;
        $client = $httpClient ?? $injectedClient;

        return NetworkProvider::api(config('multiversx.urls.api'), $client);
    }

    public static function apiWithCache(Carbon $expiresAt, ?ClientInterface $httpClient = null): ApiNetworkProvider
    {
        $stack = HandlerStack::create();

        $cacheStrategy = new GreedyCacheStrategy(
            new LaravelCacheStorage(Cache::store(config('cache.default'))),
            $expiresAt->diffInSeconds(now()),
        );

        $stack->push(new CacheMiddleware($cacheStrategy),'cache');

        $client = ClientFactory::create(config('multiversx.urls.api'), [
            'handler' => $stack,
        ]);

        $injectedClient = app()->bound(static::HttpClientContainerAbstract) ? app(static::HttpClientContainerAbstract) : null;
        $client = $httpClient ?? $injectedClient;

        return NetworkProvider::api(config('multiversx.urls.api'), $client);
    }

    public static function createMockedHttpClientWithResponses(array $responses): ClientInterface
    {
        $resolveFilePath = fn (string $value) => file_get_contents(str_starts_with($value, '/')
            ? $value
            : base_path($value));

        $toContent = fn ($value) => is_string($value) && str_ends_with($value, '.json')
            ? $resolveFilePath($value)
            : $value;

        $responses = collect($responses)
            ->map(function ($value) use ($toContent) {
                $content = $toContent($value);

                return new Response(200, [], is_array($content) ? json_encode($content) : $content);
            })
            ->all();

        $transactions = [];

        return ClientFactory::mock($responses, $transactions);
    }

    public static function mockNetworkResponses(array $responses): void
    {
        $client = self::createMockedHttpClientWithResponses($responses);

        app()->instance(static::HttpClientContainerAbstract, $client);
    }
}
