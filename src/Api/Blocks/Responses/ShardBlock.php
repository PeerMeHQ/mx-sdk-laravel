<?php

namespace Superciety\ElrondSdk\Api\Blocks\Responses;

use Superciety\ElrondSdk\Api\ResponseBase;

final class ShardBlock extends ResponseBase
{
    public function __construct(
        public string $hash,
        public int $nonce,
        public int $round,
        public int $shard,
    ) {
    }
}
