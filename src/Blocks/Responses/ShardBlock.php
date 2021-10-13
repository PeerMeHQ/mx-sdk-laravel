<?php

namespace Superciety\ElrondSdk\Blocks\Responses;

use Superciety\ElrondSdk\ResponseBase;

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
