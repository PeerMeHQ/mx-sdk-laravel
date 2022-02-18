<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Utils\Decoder;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class VmQueryResult
{
    use ApiTransformable;

    public function __construct(
        public Collection $data,
        public string $code,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'data' => collect($res['data']['returnData'] ?? [])
                ->map(fn ($v) => Decoder::fromBase64($v))
                ->values(),
            'code' => $res['data']['returnCode'] ?? 'error',
        ]);
    }
}
