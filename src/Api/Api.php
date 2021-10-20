<?php

namespace Superciety\ElrondSdk\Api;

use Exception;
use Superciety\ElrondSdk\Api\Blocks\BlockEndpoints;
use Superciety\ElrondSdk\Api\Network\NetworkEndpoints;
use Superciety\ElrondSdk\Api\Addresses\AddressEndpoints;

final class Api
{
    const MainnetApiBaseUrl = 'https://api.elrond.com';
    const TestnetApiBaseUrl = 'https://testnet-api.elrond.com';
    const DevnetApiBaseUrl = 'https://devnet-api.elrond.com';

    private string $apiBaseUrl;

    public function __construct(string $chain)
    {
        $this->apiBaseUrl = match (strtolower($chain)) {
            'm' => static::MainnetApiBaseUrl,
            't' => static::TestnetApiBaseUrl,
            'd' => static::DevnetApiBaseUrl,
            default => throw new Exception("unknown chain with identifier '{$chain}'"),
        };
    }

    public function addresses(): AddressEndpoints
    {
        return new AddressEndpoints($this->apiBaseUrl);
    }

    public function network(): NetworkEndpoints
    {
        return new NetworkEndpoints($this->apiBaseUrl);
    }

    public function blocks(): BlockEndpoints
    {
        return new BlockEndpoints($this->apiBaseUrl);
    }
}
