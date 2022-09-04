<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Brick\Math\BigInteger;
use Superciety\ElrondSdk\Api\ApiTransformable;
use Superciety\ElrondSdk\Domain\Address;

final class TransactionOperation
{
    use ApiTransformable;

    public function __construct(
        public string $id,
        public string $action,
        public string $type,
        public BigInteger $value,
        public Address $sender,
        public Address $receiver,
        public ?string $name = null,
        public ?string $collection = null,
        public ?string $identifier = null,
        public ?string $esdtType = null,
        public ?string $data = null,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'value' => isset($res['value']) ? BigInteger::of($res['value']) : BigInteger::zero(),
            'sender' => isset($res['sender']) ? Address::fromBech32($res['sender']) : null,
            'receiver' => isset($res['receiver']) ? Address::fromBech32($res['receiver']) : null,
        ]);
    }
}
