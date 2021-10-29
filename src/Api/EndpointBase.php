<?php

namespace Superciety\ElrondSdk\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

abstract class EndpointBase
{
    protected static function request(string $method, string $url, ?Carbon $cacheTtl, bool $skipDataUnwrapping = false): array
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

        return $skipDataUnwrapping ? $res : $res['data'];
    }
}
