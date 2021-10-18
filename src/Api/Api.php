<?php

namespace Superciety\ElrondSdk\Api;

use Superciety\ElrondSdk\Api\Blocks\BlockEndpoints;
use Superciety\ElrondSdk\Api\Network\NetworkEndpoints;
use Superciety\ElrondSdk\Api\Addresses\AddressEndpoints;

final class Api
{
    const MainnetApiBaseUrl = 'https://api.elrond.com';
    const TestnetApiBaseUrl = 'https://testnet-api.elrond.com';
    const DevnetApiBaseUrl = 'https://devnet-api.elrond.com';

    public function addresses(): AddressEndpoints
    {
        return new AddressEndpoints(static::MainnetApiBaseUrl);
    }

    public function network(): NetworkEndpoints
    {
        return new NetworkEndpoints(static::MainnetApiBaseUrl);
    }

    public function blocks(): BlockEndpoints
    {
        return new BlockEndpoints(static::MainnetApiBaseUrl);
    }
}
