<?php

namespace Superciety\ElrondSdk\Crypto;

use kornrunner\Keccak;

final class SignableMessage
{
    const MessagePrefix = "\x17Elrond Signed Message:\n";

    public function __construct(
        public string $message,
        public string $signature,
        public string $address,
    ) {
    }

    public function serializeForSigning(): string
    {
        return Keccak::hash(static::MessagePrefix . strlen($this->message) . $this->message, 256);
    }
}
