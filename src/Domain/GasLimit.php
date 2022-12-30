<?php

namespace Peerme\Multiversx\Domain;

final class GasLimit
{
    const MinGasLimit = 50000;
    const GasPerDataByte = 1500;

    public function __construct(
        public int $value,
    ) {
    }

    public static function forTransfer(?TransactionPayload $payload = null): GasLimit
    {
        $value = $payload !== null
            ? static::GasPerDataByte * strlen($payload->data)
            : static::MinGasLimit;

        return new static($value);
    }

    public static function min(): GasLimit
    {
        return new GasLimit(static::MinGasLimit);
    }
}
