<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Superciety\ElrondSdk\Utils\Decoder;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class Transaction
{
    use ApiTransformable;

    public function __construct(
        public string $txHash,
        public ?int $gasLimit = null,
        public ?int $gasPrice = null,
        public ?int $gasUsed = null,
        public string $miniBlockHash,
        public int $nonce,
        public string $receiver,
        public ?int $receiverShard = null,
        public string $sender,
        public ?string $senderShard = null,
        public ?string $signature = null,
        public string $status,
        public string $value,
        public ?string $fee = null,
        public ?Carbon $timestamp = null,
        public ?string $data = null,
        public ?string $tokenIdentifier = null,
        public ?string $tokenValue = null,
    ) {
    }

    public function getType(): string
    {
        return Str::before(base64_decode($this->data), '@');
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'data' => isset($res['data']) ? Decoder::fromBase64($res['data']) : null,
            'timestamp' => isset($res['timestamp']) ? Carbon::createFromTimestampUTC($res['timestamp']) : null,
        ]);
    }

    public static function fromGatewayTransaction(GatewayTransaction $gwTx): Transaction
    {
        return new static(
            txHash: $gwTx->hash,
            gasLimit: $gwTx->gasLimit,
            gasPrice: $gwTx->gasPrice,
            gasUsed: null,
            miniBlockHash: $gwTx->miniblockHash,
            nonce: $gwTx->nonce,
            receiver: $gwTx->receiver,
            receiverShard: $gwTx->destinationShard,
            sender: $gwTx->sender,
            senderShard: $gwTx->sourceShard,
            signature: $gwTx->signature,
            status: $gwTx->status,
            value: $gwTx->value,
            fee: null,
            timestamp: null,
            data: $gwTx->data,
            tokenIdentifier: null,
            tokenValue: null,
        );
    }
}
