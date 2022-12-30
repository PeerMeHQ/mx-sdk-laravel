<?php

namespace Peerme\Multiversx\Api\Entities;

use Illuminate\Support\Collection;
use Peerme\Multiversx\Api\ApiTransformable;
use Peerme\Multiversx\Api\Entities\TransactionLogEvent;
use Peerme\Multiversx\Domain\Address;

final class TransactionLog
{
    use ApiTransformable;

    public function __construct(
        public string $id,
        public Address $address,
        public Collection $events,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'address' => isset($res['address']) ? Address::fromBech32($res['address']) : null,
            'events' => isset($res['events']) ? TransactionLogEvent::fromApiResponseMany($res['events']) : collect(),
        ]);
    }
}
