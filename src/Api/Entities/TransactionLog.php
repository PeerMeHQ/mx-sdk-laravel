<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\ApiTransformable;
use Superciety\ElrondSdk\Api\Entities\TransactionLogEvent;
use Superciety\ElrondSdk\Domain\Address;

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
