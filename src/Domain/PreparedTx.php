<?php

namespace Superciety\ElrondSdk\Domain;

class PreparedTx
{
    public function __construct(
        public string $receiver,
        public Balance $value,
        public TransactionPayload $data,
        public int $gasLimit,
    ) {
    }

    public static function issueNonFungible(TransactionPayload $payload): PreparedTx
    {
        return new static(
            receiver: 'erd1qqqqqqqqqqqqqqqpqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqzllls8a5w6u',
            value: Balance::egld(0.05),
            data: $payload,
            gasLimit: 60000000,
        );
    }

    public static function mintNft(TransactionPayload $payload, string $receiver): PreparedTx
    {
        return new static(
            receiver: $receiver,
            value: Balance::egld(0),
            data: $payload,
            gasLimit: 60000000,
        );
    }

    public static function setNftRoles(TransactionPayload $payload): PreparedTx
    {
        return new static(
            receiver: 'erd1qqqqqqqqqqqqqqqpqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqzllls8a5w6u',
            value: Balance::egld(0),
            data: $payload,
            gasLimit: 60000000,
        );
    }

    public static function burnNft(TransactionPayload $payload, string $receiver): PreparedTx
    {
        return new static(
            receiver: $receiver,
            value: Balance::egld(0),
            data: $payload,
            gasLimit: 10000000,
        );
    }

    public function getChainId(): string
    {
        return config('elrond.chain_id', '1');
    }
}
