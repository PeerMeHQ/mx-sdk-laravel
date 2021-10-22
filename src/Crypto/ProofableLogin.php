<?php

namespace Superciety\ElrondSdk\Crypto;

final class ProofableLogin
{
    public function __construct(
        public string $token,
        public string $signature,
        public string $signer,
    ) {
    }
}
