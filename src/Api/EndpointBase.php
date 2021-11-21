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

        $res = Http::send($method, $url . '?' . http_build_query($params))
            ->throw()
            ->json();

        if ($this->cacheTtl) {
            Cache::put($cacheKey, $res, $this->cacheTtl);
        }

        return $unwrapData ? $res['data'] : $res;
    }
}
