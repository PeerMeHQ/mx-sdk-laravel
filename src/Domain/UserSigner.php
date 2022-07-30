<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Domain\Interfaces\ISignable;

class UserSigner
{
    public function __construct(
        private UserSecretKey $secretKey,
    ) {
    }

    public static function fromPem(string $text, int $index = 0): UserSigner
    {
        return new UserSigner(UserSecretKey::fromPem($text, $index));
    }

    public function sign(string|ISignable $signable): Signature
    {
        if ($signable instanceof Transaction) {
            $sigHex = $this->secretKey->sign($signable->serializeForSigning());
            $signature = new Signature($sigHex);
            $signable->applySignature($signature);

            return $signature;
        }

        return new Signature($this->secretKey->sign($signable));
    }
}
