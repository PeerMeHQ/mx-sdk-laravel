<?php

namespace Superciety\ElrondSdk\Utils;

use Superciety\ElrondSdk\Domain\Address;

class Encoder
{
    public static function toHex(string|int $value): string
    {
        if (is_string($value)) {
            return str_starts_with($value, 'erd1')
                ? Address::fromBech32($value)->hex()
                : bin2hex(trim($value));
        }

        return static::numberToPaddedHex($value);
    }

    public static function numberToPaddedHex(int $value): string
    {
        $padding = '0';
        $hex = dechex($value);

        return strlen($hex) % 2 === 1 ? $padding . $hex : $hex;
    }
}
