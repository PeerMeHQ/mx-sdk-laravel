<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Brick\Math\BigInteger;
use Superciety\ElrondSdk\Domain\Address;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class Account
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public int $nonce,
        public BigInteger $balance,
        public int $txCount,
        public int $shard,
        public ?string $username = null,
        public ?string $rootHash = null,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => Address::fromBech32($res['address']),
            'balance' => BigInteger::of($res['balance'] ?? 0)
        ]);
    }
}
