<?php

namespace Superciety\ElrondSdk\Crypto;

use Exception;
use Elliptic\EdDSA;
use function BitWasp\Bech32\decode;
use function BitWasp\Bech32\convertBits;

final class Crypto
{
    public function verify(SignableMessage $signedMessage): bool
    {
        return (new EdDSA('ed25519'))
            ->keyFromPublic($this->decodeBech32ToHex($signedMessage->address))
            ->verify($signedMessage->serializeForSigning(), $signedMessage->signature);
    }

    public function verifyLogin(ProofableLogin $proofableLogin): bool
    {
        return $this->verify(new SignableMessage(
            message: "{$proofableLogin->address}{$proofableLogin->token}{}", // how elrond wallet providers sign login messages
            signature: $proofableLogin->signature,
            address: $proofableLogin->address,
        ));
    }

    public function decodeBech32ToHex(string $address): string
    {
        throw_unless(strlen($address) === 62, Exception::class, 'invalid length');

        $decoded = decode($address)[1];
        $res = convertBits($decoded, count($decoded), 5, 8, false);

        return collect($res)
            ->map(fn ($bits) => dechex($bits))
            ->reduce(fn ($carry, $hex) => $carry . (strlen($hex) === 1 ? "0$hex" : $hex));
    }
}
