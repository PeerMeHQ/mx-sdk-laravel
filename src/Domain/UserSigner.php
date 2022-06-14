<?php

namespace Superciety\ElrondSdk\Domain;

use Elliptic\EdDSA;

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

    public function sign(string $message): string
    {
        return $this->secretKey->sign($message);
    }
}
