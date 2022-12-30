<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;
use Peerme\Multiversx\Domain\Address;

final class TransactionSendResult
{
    use ApiTransformable;

    public function __construct(
        public Address $receiver,
        public int $receiverShard,
        public Address $sender,
        public int $senderShard,
        public string $status,
        public string $txHash,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'receiver' => Address::fromBech32($res['receiver']),
            'sender' => Address::fromBech32($res['sender']),
        ]);
    }
}
