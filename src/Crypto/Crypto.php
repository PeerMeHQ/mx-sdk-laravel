<?php

namespace Peerme\Multiversx\Crypto;

use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Domain\Signature;
use Peerme\Multiversx\Domain\UserVerifier;
use Peerme\Multiversx\Domain\SignableMessage;

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
