<?php

namespace Superciety\ElrondSdk\Api;

use Exception;
use Carbon\Carbon;
use Superciety\ElrondSdk\Api\Blocks\BlockEndpoints;
use Superciety\ElrondSdk\Api\Network\NetworkEndpoints;
use Superciety\ElrondSdk\Api\Accounts\AccountEndpoints;

final class Api
{
    const MainnetApiBaseUrl = 'https://api.elrond.com';
    const TestnetApiBaseUrl = 'https://testnet-api.elrond.com';
    const DevnetApiBaseUrl = 'https://devnet-api.elrond.com';

    private string $apiBaseUrl;
    private ?Carbon $cacheTtl = null;

    public function __construct(string $chain)
    {
        $this->apiBaseUrl = match (strtolower($chain)) {
            'm' => static::MainnetApiBaseUrl,
            't' => static::TestnetApiBaseUrl,
            'd' => static::DevnetApiBaseUrl,
            default => throw new Exception("unknown chain with identifier '{$chain}'"),
        };
    }

    public function cacheFor(Carbon $ttl): self
    {
        $this->cacheTtl = $ttl;

        return $this;
    }

    public function accounts(): AccountEndpoints
    {
        return new AccountEndpoints($this->apiBaseUrl, $this->cacheTtl);
    }

    public function network(): NetworkEndpoints
    {
        return new NetworkEndpoints($this->apiBaseUrl, $this->cacheTtl);
    }

    public function blocks(): BlockEndpoints
    {
        return new BlockEndpoints($this->apiBaseUrl, $this->cacheTtl);
    }
}
