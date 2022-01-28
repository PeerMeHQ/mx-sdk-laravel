<?php

namespace Superciety\ElrondSdk\Utils;

use Exception;
use function BitWasp\Bech32\decode;
use function BitWasp\Bech32\convertBits;

class Decoder
{
    public static function bech32ToHex(string $address): string
    {
        throw_unless(strlen($address) === 62, Exception::class, 'invalid length');

        $decoded = decode(strtolower($address))[1];
        $res = convertBits($decoded, count($decoded), 5, 8, false);

        return collect($res)
            ->map(fn ($bits) => dechex($bits))
            ->reduce(fn ($carry, $hex) => $carry . (strlen($hex) === 1 ? "0$hex" : $hex));
    }

    public static function fromBase64(string $value): string|int
    {
        $decoded = base64_decode($value);

        return ctype_print($decoded) // check if has been fully decoded or still has binary data (assume hex dec)
            ? $decoded
            : hexdec(bin2hex($decoded));
    }
}
