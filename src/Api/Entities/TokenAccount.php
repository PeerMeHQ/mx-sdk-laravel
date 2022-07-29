<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Brick\Math\BigInteger;
use Superciety\ElrondSdk\Domain\Address;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class TokenAccount
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public BigInteger $balance,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'address' => Address::fromBech32($res['address']),
            'balance' => BigInteger::of($res['balance'] ?? 0),
        ])));
    }
}
