<?php

namespace Superciety\ElrondSdk\Domain;

use Brick\Math\BigInteger;
use Superciety\ElrondSdk\Domain\Interfaces\ISignable;

class Transaction implements ISignable
{
    const MIN_GAS_PRICE = 1_000_000_000;
    const VERSION_DEFAULT = 1;
    const OPTIONS_DEFAULT = 0;

    public ?Signature $signature = null;

    public function __construct(
        public int $nonce,
        public BigInteger $value,
        public Address $sender,
        public Address $receiver,
        public int $gasPrice = self::MIN_GAS_PRICE,
        public int $gasLimit,
        public ?TransactionPayload $data = null,
        public string $chainID = '1',
        public int $version = self::VERSION_DEFAULT,
        public int $options = self::OPTIONS_DEFAULT,
    ) {
    }

    public function serializeForSigning(): string
    {
        return bin2hex(json_encode($this->toArray()));
    }

    public function toArray(): array
    {
        return collect([
            'nonce' => $this->nonce,
            'value' => (string) $this->value,
            'receiver' => $this->receiver->bech32(),
            'sender' => $this->sender->bech32(),
            'gasPrice' => $this->gasPrice,
            'gasLimit' => $this->gasLimit,
            'data' => $this->data?->toBase64(),
            'chainID' => $this->chainID,
            'version' => $this->version,
            'options' => $this->options === 0 ? null : $this->options,
            'signature' => $this->signature?->hex(),
        ])
            ->reject(fn ($field) => $field === null)
            ->toArray();
    }

    public function applySignature(Signature $signature): void
    {
        $this->signature = $signature;
    }

    public function toSendable(): array
    {
        return $this->toArray();
    }
}
