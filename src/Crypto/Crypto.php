<?php

namespace Superciety\ElrondSdk\Crypto;

use Superciety\ElrondSdk\Domain\Address;
use Superciety\ElrondSdk\Domain\Signature;
use Superciety\ElrondSdk\Domain\UserVerifier;
use Superciety\ElrondSdk\Domain\SignableMessage;

final class Crypto
{
    public function verifyLogin(string $token, Signature|string $signature, Address|string $address): bool
    {
        $address = $address instanceof Address ? $address : Address::fromBech32($address);
        $signature = $signature instanceof Signature ? $signature : new Signature($signature);

        $verifiable = new SignableMessage(
            message: "{$address->bech32()}{$token}{}", // how elrond wallet providers sign login messages
            signature: $signature,
            address: $address,
        );

        return UserVerifier::fromAddress($address)
            ->verify($verifiable);
    }
}
