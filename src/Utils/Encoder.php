<?php

namespace Superciety\ElrondSdk\Utils;

use Superciety\ElrondSdk\Domain\Address;

class Encoder
{
    public static function toHex(string|int $value, bool $skipHexBytePadding = false): string
    {
        if (is_string($value)) {
            return str_starts_with($value, 'erd1')
                ? Address::fromBech32($value)->hex()
                : bin2hex(trim($value));
        }

        return $skipHexBytePadding
            ? dechex($value)
            : static::toPaddedHex(dechex($value));
    }

    public static function toPaddedHex(string|int $value): string
    {
        return strlen($value) % 2 === 1 ? '0' . $value : $value;
    }
}
