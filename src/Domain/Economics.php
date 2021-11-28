<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class Economics
{
    use ApiTransformable;

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
