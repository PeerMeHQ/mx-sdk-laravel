<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Carbon\Carbon;
use Brick\Math\BigInteger;
use Superciety\ElrondSdk\Domain\Address;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class SmartContractResult
{
    use ApiTransformable;

    public function __construct(
        public string $hash = '',
        public ?Carbon $timestamp = null,
        public int $nonce = 0,
        public int $gasLimit = 0,
        public int $gasPrice = 0,
        public ?BigInteger $value = null,
        public ?Address $sender = null,
        public ?Address $receiver = null,
        public ?string $relayedValue = '',
        public ?string $data = null,
        public ?string $prevTxHash = '',
        public ?string $originalTxHash = '',
        public ?string $callType = '',
        public ?string $miniBlockHash = '',
        public ?string $returnMessage = '',
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'timestamp' => isset($res['timestamp']) ? Carbon::createFromTimestampUTC($res['timestamp']) : null,
            'data' => isset($res['data']) ? base64_decode($res['data']) : null,
            'value' => isset($res['value']) ? BigInteger::of($res['value']) : null,
            'sender' => isset($res['sender']) ? Address::fromBech32($res['sender']) : null,
            'receiver' => isset($res['receiver']) ? Address::fromBech32($res['receiver']) : null,
        ]);
    }
}
