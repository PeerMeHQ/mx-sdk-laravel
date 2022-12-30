<?php

namespace Peerme\Multiversx\Utils;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Timeout
{
    public static function for(string $uniqueAction, Carbon $endsAt, callable $action): bool
    {
        $safeCacheKey = 'timeout:'.Str::slug($uniqueAction);

        if (Cache::has($safeCacheKey)) {
            return false;
        }

        $action();

        Cache::put($safeCacheKey, true, $endsAt);

        return true;
    }
}
