<?php

namespace Peerme\Multiversx\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

abstract class EndpointBase
{
    protected function getApiBaseUrl()
    {
        return trim(config('elrond.urls.api'), '/');
    }

    protected function request(string $method, string $url, array $params = [], bool $unwrapData = false)
    {
        $serializedParams = collect($params)->flatten()->implode(',');
        $cacheKey = Str::lower("{$method}-{$url}".$serializedParams);

        if ($this->cacheTtl && $cached = Cache::get($cacheKey)) {
            return $cached;
        }

        $res = match (strtoupper($method)) {
            'GET' => Http::get($url, $params),
            'POST' => Http::post($url, $params),
        };

        $unpacked = $res->throw()->json();

        if ($this->cacheTtl) {
            Cache::put($cacheKey, $unpacked, $this->cacheTtl);
        }

        return $unwrapData ? $unpacked['data'] : $unpacked;
    }
}
