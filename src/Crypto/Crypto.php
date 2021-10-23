<?php

namespace Superciety\ElrondSdk\Crypto;

use Exception;
use Elliptic\EdDSA;
use kornrunner\Keccak;
use function BitWasp\Bech32\decode;
use function BitWasp\Bech32\convertBits;

final class Crypto
{
    const MessagePrefix = "\x17Elrond Signed Message:\n";

    public function verify(SignedMessage $signedMessage): bool
    {
        $signerHex = $this->convertAddressBech32ToHex($signedMessage->signer);

        $ec = new EdDSA('ed25519');
        $key = $ec->keyFromPublic($signerHex);

        return $key->verify($signedMessage->message, $signedMessage->signature);
    }

    public function verifyLogin(ProofableLogin $proofableLogin): bool
    {
        return $this->verify(new SignedMessage(
            message: $this->keccak("{$proofableLogin->signer}{$proofableLogin->token}{}"), // how elrond wallet providers sign logins
            signature: $proofableLogin->signature,
            signer: $proofableLogin->signer,
        ));
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

    public function keccak(string $message): string
    {
        return Keccak::hash(static::MessagePrefix . strlen($message) . $message, 256);
    }
}
