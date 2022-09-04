<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Brick\Math\BigInteger;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class TransactionDetailed
{
    use ApiTransformable;

    public function __construct(
        public string $txHash,
        public int $nonce,
        public string $receiver,
        public string $sender,
        public string $status,
        public BigInteger $value,
        public ?int $gasLimit = null,
        public ?int $gasPrice = null,
        public ?int $gasUsed = null,
        public ?string $miniBlockHash = null,
        public ?int $receiverShard = null,
        public ?string $senderShard = null,
        public ?string $signature = null,
        public ?string $fee = null,
        public ?Carbon $timestamp = null,
        public ?string $data = null,
        public ?string $function = null,
        public ?string $tokenIdentifier = null,
        public ?string $tokenValue = null,
        public Collection $results = new Collection,
        public ?TransactionLog $logs = null,
        public Collection $operations =  new Collection,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'value' => isset($res['value']) ? BigInteger::of($res['value']) : BigInteger::zero(),
            'data' => isset($res['data']) ? base64_decode($res['data']) : null,
            'timestamp' => isset($res['timestamp']) ? Carbon::createFromTimestampUTC($res['timestamp']) : null,
            'results' => isset($res['results']) ? SmartContractResult::fromApiResponseMany($res['results']) : collect(),
            'logs' => isset($res['logs']) ? TransactionLog::fromApiResponse($res['logs']) : null,
            'operations' => isset($res['operations']) ? TransactionOperation::fromApiResponseMany($res['operations']) : collect(),
        ]);
    }
}
