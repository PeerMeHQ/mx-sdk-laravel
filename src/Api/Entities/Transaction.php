<?php

namespace Peerme\Multiversx\Api\Entities;

use Carbon\Carbon;
use Peerme\Multiversx\Api\ApiTransformable;

final class Transaction
{
    use ApiTransformable;

    public function __construct(
        public string $txHash,
        public int $nonce,
        public string $receiver,
        public string $sender,
        public string $status,
        public string $value,
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
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'data' => isset($res['data']) ? base64_decode($res['data']) : null,
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
