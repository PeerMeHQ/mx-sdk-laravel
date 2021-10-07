<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Network\Network;

class ElrondApi
{
    const MainnetApiBaseUrl = 'https://api.elrond.com';
    const TestnetApiBaseUrl = 'https://testnet-api.elrond.com';
    const DevnetApiBaseUrl = 'https://devnet-api.elrond.com';

    public static function network(): Network
    {
        return new Network(static::MainnetApiBaseUrl);
    }
}
