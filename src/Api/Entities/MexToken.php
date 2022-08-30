<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class MexToken
{
    use ApiTransformable;

    public function __construct(
        public string $id,
        public string $symbol,
        public string $name,
        public float $price,
    ) {
    }
}
