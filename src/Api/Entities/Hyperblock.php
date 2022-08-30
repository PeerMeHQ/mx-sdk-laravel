<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\ApiTransformable;
use Superciety\ElrondSdk\Api\Entities\Transaction;

final class Hyperblock
{
    use ApiTransformable;

    public function __construct(
        public int $nonce,
        public int $round,
        public string $hash,
        public string $prevBlockHash,
        public int $epoch,
        public int $numTxs,
        /** @var Collection $shardBlocks */
        public Collection $shardBlocks,
        /** @var Collection $transactions */
        public Collection $transactions,
        public string $developerFees,
        public string $accumulatedFeesInEpoch,
        public string $developerFeesInEpoch,
        public string $status,
        public ?int $timestamp = null,
    ) {
    }

    public static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'shardBlocks' => ShardBlock::fromApiResponseMany($res['shardBlocks'] ?? []),
            'transactions' => GatewayTransaction::fromApiResponseMany($res['transactions'] ?? [])
                ->map(fn (GatewayTransaction $gwTx) => Transaction::fromGatewayTransaction($gwTx)),
        ]);
    }
}
