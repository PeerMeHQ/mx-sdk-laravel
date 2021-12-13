<?php

namespace Superciety\ElrondSdk\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

abstract class EndpointBase
{
    protected function getApiBaseUrl()
    {
        return trim(config('elrond.urls.api'), '/');
    }

    protected function request(string $method, string $url, array $params = [], bool $unwrapData = false): array
    {
        $cacheKey = Str::lower("{$method}-{$url}");

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
