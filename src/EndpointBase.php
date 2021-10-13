<?php

namespace Superciety\ElrondSdk;

use Illuminate\Support\Facades\Http;

abstract class EndpointBase
{
    protected static function request(string $method, string $url): array
    {
        return Http::send($method, $url)
            ->throw()
            ->json()['data'];
    }
}
