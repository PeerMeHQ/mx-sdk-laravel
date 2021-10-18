<?php

namespace Superciety\ElrondSdk\Crypto;

/**
 * all values have to be hex encoded.
 */
final class SignedMessage
{
    public function __construct(
        public string $message,
        public string $signature,
        public string $signer,
    ) {
    }
}
