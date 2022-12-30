<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Api\ApiTransformable;

final class NftOwner
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public int $balance,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => Address::fromBech32($res['address']),
            'balance' => (int) $res['balance'],
        ]);
    }
}
