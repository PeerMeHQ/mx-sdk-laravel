<?php

namespace Superciety\ElrondSdk\Api\Blocks\Responses;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\ResponseBase;

final class Hyperblock extends ResponseBase
{
    public function __construct(
        public int $nonce,
        public int $round,
        public string $hash,
        public string $prevBlockHash,
        public int $epoch,
        public int $numTxs,
        /** @var Collection|\Superciety\ElrondSdk\Blocks\Responses\ShardBlock[] $shardBlocks */
        public Collection $shardBlocks,
        /** @var Collection|\Superciety\ElrondSdk\Blocks\Responses\Transaction[] $transactions */
        public Collection $transactions,
        public ?int $timestamp = null,
        public string $developerFees,
        public string $accumulatedFeesInEpoch,
        public string $developerFeesInEpoch,
        public string $status,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'shardBlocks' => ShardBlock::fromApiResponseMany($res['shardBlocks']),
            'transactions' =>  Transaction::fromApiResponseMany($res['transactions']),
        ])));
    }
}
