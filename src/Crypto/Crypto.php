<?php

namespace Superciety\ElrondSdk\Crypto;

use Exception;
use Elliptic\EdDSA;
use function BitWasp\Bech32\decode;
use function BitWasp\Bech32\convertBits;

final class Crypto
{
    public function verify(SignedMessage $signedMessage): bool
    {
        $ec = new EdDSA('ed25519');
        $key = $ec->keyFromPublic($signedMessage->signer);

        return $key->verify($signedMessage->message, $signedMessage->signature);
    }

    public function convertAddressBech32ToHex(string $address): string
    {
        if (strlen($address) !== 62) {
            throw new Exception('address has invalid length.');
        }

        $result = decode($address)[1];
        $result = convertBits($result, count($result), 5, 8, false);
        $resultString = "";

        for ($i = 0; $i < count($result); $i++) {
            $hex = dechex($result[$i]);

            if (strlen($hex) == 1) {
                $hex = "0".$hex;
            }
            $resultString = $resultString . $hex;
        }

        return $resultString;
    }
}
