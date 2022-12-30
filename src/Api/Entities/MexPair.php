<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

final class MexPair
{
    use ApiTransformable;

    public function __construct(
        public string $baseId,
        public float $basePrice,
        public string $baseSymbol,
        public string $baseName,
        public string $quoteId,
        public float $quotePrice,
        public string $quoteSymbol,
        public string $quoteName,
        public string $totalValue,
        public ?string $volume24h = null,
    ) {
    }
}
