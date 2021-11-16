<?php

namespace Superciety\ElrondSdk\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

abstract class EndpointBase
{
    protected function getApiBaseUrl()
    {
        return trim(config('elrond.urls.api'), '/');
    }

    protected static function request(string $method, string $url, ?Carbon $cacheTtl, bool $unwrapData = false): array
    {
        $cacheKey = Str::lower("{$method}-{$url}");

        if ($cacheTtl && $cached = Cache::get($cacheKey)) {
            return $cached;
        }

        $res = Http::send($method, $url)
            ->throw()
            ->json();

        if ($cacheTtl) {
            Cache::put($cacheKey, $res, $cacheTtl);
        }

        return $unwrapData ? $res['data'] : $res;
    }
}
