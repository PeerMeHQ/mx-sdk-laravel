<?php

namespace Superciety\ElrondSdk\Network\Responses;

use Superciety\ElrondSdk\ResponseBase;

class Economics extends ResponseBase
{
    public function __construct(
        private int $totalSupply,
        private int $circulatingSupply,
        private int $staked,
        private int $price,
        private int $marketCap,
        private int $apr,
        private int $topUpApr,
        private int $baseApr,
    ) {}
}
