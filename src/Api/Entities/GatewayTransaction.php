<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

final class GatewayTransaction
{
    use ApiTransformable;

    public function __construct(
        public string $type,
        public string $hash,
        public int $nonce,
        public string $value,
        public string $receiver,
        public string $sender,
        public int $sourceShard,
        public int $destinationShard,
        public string $miniblockType,
        public string $miniblockHash,
        public string $status,
        public ?int $gasPrice = null,
        public ?int $gasLimit = null,
        public ?string $data = null,
        public ?string $signature = null,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'data' => isset($res['data']) ? base64_decode($res['data']) : null,
        ]);
    }
}
