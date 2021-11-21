<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Superciety\ElrondSdk\Api\ResponseBase;

final class Transaction extends ResponseBase
{
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
        $dataHint = Str::before(base64_decode($this->data), '@');

        return match ($dataHint) {
            'ESDTNFTCreate' => 'nft_create',
            'ESDTNFTTransfer' => 'nft_transfer',
            default => 'unknown',
        };
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
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
