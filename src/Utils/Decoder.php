<?php

namespace Superciety\ElrondSdk\Utils;

class Decoder
{
    public static function fromBase64(string $value): string|int
    {
        $decoded = base64_decode($value);

        return ctype_print($decoded) // check if has been fully decoded or still has binary data (assume hex dec)
            ? $decoded
            : hexdec(bin2hex($decoded));
    }
}
