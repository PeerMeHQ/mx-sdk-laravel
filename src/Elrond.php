<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Api\Api;
use Superciety\ElrondSdk\Crypto\Crypto;

final class Elrond
{
    public static function api(string $chain = 'M'): Api
    {
        return new Api($chain);
    }

    public static function crypto(): Crypto
    {
        return new Crypto();
    }
}
