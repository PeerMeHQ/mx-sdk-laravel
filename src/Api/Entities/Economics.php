<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ResponseBase;

final class Economics extends ResponseBase
{
    public function __construct(
        public int $totalSupply,
        public int $circulatingSupply,
        public int $staked,
        public float $price,
        public int $marketCap,
        public float $apr,
        public float $topUpApr,
        public float $baseApr,
    ) {
    }
}
