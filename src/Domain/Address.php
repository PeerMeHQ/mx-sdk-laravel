<?php

namespace Superciety\ElrondSdk\Domain;

use InvalidArgumentException;
use function BitWasp\Bech32\decode;
use function BitWasp\Bech32\encode;
use function BitWasp\Bech32\convertBits;

class Address
{
    const HRP = 'erd';
    const SMART_CONTRACT_HEX_PUBKEY_PREFIX = '0000000000000000';

    private function __construct(
        private string $valueHex,
    ) {
    }

    public static function fromHex(string $value): Address
    {
        throw_unless($value, InvalidArgumentException::class, 'hex value is required');

        return new Address($value);
    }

    public static function fromBech32(string $address): Address
    {
        throw_unless(strlen($address) === 62, Exception::class, 'invalid address length');

        $decoded = decode(strtolower($address))[1];
        $res = convertBits($decoded, count($decoded), 5, 8, false);

        $hex = collect($res)
            ->map(fn ($bits) => dechex($bits))
            ->reduce(fn ($carry, $hex) => $carry . str_pad($hex, 2, "0", STR_PAD_LEFT));

        return new Address($hex);
    }

    public static function fromBase64(string $value): Address
    {
        return new Address(bin2hex(base64_decode($value)));
    }

    public static function zero(): Address
    {
        return new Address(str_repeat('0', 64));
    }

    public function hex(): string
    {
        return $this->valueHex;
    }

    public function bech32(): string
    {
        $bin = hex2bin($this->valueHex);
        $bits = array_values(unpack('C*', $bin));

        return encode(self::HRP, convertBits($bits, count($bits), 8, 5));
    }

    public function isContractAddress(): bool
    {
        return str_starts_with($this->valueHex, self::SMART_CONTRACT_HEX_PUBKEY_PREFIX);
    }
}
