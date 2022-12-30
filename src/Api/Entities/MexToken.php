<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

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
