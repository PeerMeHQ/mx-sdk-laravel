<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Api\ApiTransformable;

final class TokenAddressRoles
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public array $roles = [],
    ) {
    }

    public static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => Address::fromBech32($res['address']),
        ]);
    }
}
