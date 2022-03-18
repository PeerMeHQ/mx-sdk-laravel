<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Domain\Address;
use Superciety\ElrondSdk\Api\ApiTransformable;

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
