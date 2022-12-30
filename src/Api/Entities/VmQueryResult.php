<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

final class VmQueryResult extends VmResultBase
{
    use ApiTransformable;

    public function __construct(
        public $data,
        public string $code,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'data' => $res['data']['returnData'] ?? [],
            'code' => $res['data']['returnCode'] ?? 'error',
        ]);
    }
}
