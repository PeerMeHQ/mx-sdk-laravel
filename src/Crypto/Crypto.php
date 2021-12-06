<?php

namespace Superciety\ElrondSdk\Crypto;

use Elliptic\EdDSA;
use Superciety\ElrondSdk\Utils\Decoder;

final class Crypto
{
    public function verify(SignableMessage $signedMessage): bool
    {
        return (new EdDSA('ed25519'))
            ->keyFromPublic(Decoder::bech32ToHex($signedMessage->address))
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
}
