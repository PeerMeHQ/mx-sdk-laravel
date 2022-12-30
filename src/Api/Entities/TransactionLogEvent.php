<?php

namespace Peerme\Multiversx\Api\Entities;

use Illuminate\Support\Collection;
use Peerme\Multiversx\Api\ApiTransformable;
use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Utils\Decoder;

final class TransactionLogEvent
{
    use ApiTransformable;

    public function __construct(
        public Address $address,
        public string $identifier,
        public Collection $topics,
        public ?string $data = null,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => isset($res['address']) ? Address::fromBech32($res['address']) : null,
            'topics' => isset($res['topics']) ? collect($res['topics']) : [],
        ]);
    }
}
