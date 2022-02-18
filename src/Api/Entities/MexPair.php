<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Domain\Balance;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class MexPair
{
    use ApiTransformable;

    public function __construct(
        public string $baseId,
        public Balance $basePrice,
        public string $baseSymbol,
        public string $baseName,
        public string $quoteId,
        public string $quotePrice,
        public string $quoteSymbol,
        public string $quoteName,
        public string $totalValue,
        public ?string $volume24h = null,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'basePrice' => Balance::egld($res['basePrice']),
        ])));
    }
}
