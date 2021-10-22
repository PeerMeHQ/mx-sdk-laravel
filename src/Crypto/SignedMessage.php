<?php

namespace Superciety\ElrondSdk\Crypto;

final class SignedMessage
{
    public function __construct(
        public string $message,
        public string $signature,
        public string $signer,
    ) {
    }
}
