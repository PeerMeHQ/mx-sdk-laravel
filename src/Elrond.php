<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Api\Api;
use Superciety\ElrondSdk\Crypto\Crypto;

final class Elrond
{
    public static function api(): Api
    {
        return new Api();
    }

    public static function crypto(): Crypto
    {
        return new Crypto();
    }
}
