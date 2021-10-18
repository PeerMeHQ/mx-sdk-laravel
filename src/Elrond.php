<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Api\Api;

final class Elrond
{
    public static function api(): Api
    {
        return new Api();
    }
}
