<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Blocks\BlockEndpoints;
use Superciety\ElrondSdk\Network\NetworkEndpoints;

final class ElrondApi
{
    const MainnetApiBaseUrl = 'https://api.elrond.com';
    const TestnetApiBaseUrl = 'https://testnet-api.elrond.com';
    const DevnetApiBaseUrl = 'https://devnet-api.elrond.com';

    public static function network(): NetworkEndpoints
    {
        return new NetworkEndpoints(static::MainnetApiBaseUrl);
    }

    public static function blocks(): BlockEndpoints
    {
        return new BlockEndpoints(static::MainnetApiBaseUrl);
    }
}
