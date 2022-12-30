<?php

namespace Peerme\Multiversx\Domain;

use kornrunner\Keccak;
use Peerme\Multiversx\Domain\Interfaces\IVerifiable;

final class SignableMessage implements IVerifiable
{
    const MessagePrefix = "\x17Elrond Signed Message:\n";

    public function __construct(
        public string $message,
        public Signature $signature,
        public Address $address,
    ) {
    }

    public function serializeForSigning(): string
    {
        return Keccak::hash(static::MessagePrefix . strlen($this->message) . $this->message, 256);
    }

    public function getSignature(): Signature
    {
        return $this->signature;
    }
}
