<?php

namespace Superciety\ElrondSdk\Blocks\Responses;

use Superciety\ElrondSdk\ResponseBase;

final class Hyperblock extends ResponseBase
{
    public function __construct(
        public int $nonce,
        public int $round,
        public string $hash,
        public string $prevBlockHash,
        public int $epoch,
        public int $numTxs,
        /** @var ShardBlock[] $shardBlocks */
        public array $shardBlocks,
        /** @var Transaction[] $transactions */
        public array $transactions,
    ) {
    }

    public static function fromResponse(array $res): static
    {
        return new static(...array_merge($res, [
            'shardBlocks' => ShardBlock::fromResponseMany($res['shardBlocks']),
            'transactions' =>  Transaction::fromResponseMany($res['transactions']),
        ]));
    }
}
