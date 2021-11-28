<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class ShardBlock
{
    use ApiTransformable;

    public function __construct(
        public string $hash,
        public int $nonce,
        public int $round,
        public int $shard,
    ) {
    }
}
