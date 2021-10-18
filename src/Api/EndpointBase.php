<?php

namespace Superciety\ElrondSdk\Api;

use Illuminate\Support\Facades\Http;

abstract class EndpointBase
{
    protected static function request(string $method, string $url, bool $skipDataUnwrapping = false): array
    {
        $res = Http::send($method, $url)
            ->throw()
            ->json();

        return $skipDataUnwrapping ? $res : $res['data'];
    }
}
