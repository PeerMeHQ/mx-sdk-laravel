<?php

namespace Superciety\ElrondSdk\Utils;

class Decoder
{
    public static function fromBase64(string $value): string|int
    {
        $decoded = base64_decode($value);

        return ctype_print($decoded) // check if has been fully decoded or still has binary data (assume hex dec)
            ? $decoded
            : static::bchexdec(bin2hex($decoded));
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
