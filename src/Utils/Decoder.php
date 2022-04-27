<?php

namespace Superciety\ElrondSdk\Utils;

class Decoder
{
    public static function fromBase64Int(string $value): int
    {
        return hexdec(bin2hex(base64_decode($value)));
    }

    public static function fromBase64BigUint(string $value): string
    {
        $decoded = base64_decode($value);

        return static::bchexdec(bin2hex($decoded));
    }

    public static function fromBase64U32(string $value): int
    {
        return unpack("N*", base64_decode($value))[1];
    }

    public static function bchexdec(string $value): string
    {
        $dec = 0;
        $len = strlen($value);
        for ($i = 1; $i <= $len; $i++) {
            $dec = bcadd($dec, bcmul(strval(hexdec($value[$i - 1])), bcpow('16', strval($len - $i))));
        }
        return $dec;
    }
}
