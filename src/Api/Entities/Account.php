<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class Account
{
    use ApiTransformable;

    public function __construct(
        public string $address,
        public int $nonce,
        public string $balance,
        public int $txCount,
        public int $shard,
        public ?string $username = null,
        public ?string $rootHash = null,
    ) {
    }
}
