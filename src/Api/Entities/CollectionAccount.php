<?php

namespace Peerme\Multiversx\Api\Entities;

use Brick\Math\BigInteger;
use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Api\ApiTransformable;

final class CollectionAccount
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public BigInteger $balance,
    ) {
    }

    public static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => Address::fromBech32($res['address']),
            'balance' => BigInteger::of($res['balance'] ?? 1),
        ]);
    }
}
