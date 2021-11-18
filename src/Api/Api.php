<?php

namespace Superciety\ElrondSdk\Api;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\Endpoints\NftEndpoints;
use Superciety\ElrondSdk\Api\Endpoints\BlockEndpoints;
use Superciety\ElrondSdk\Api\Endpoints\AccountEndpoints;
use Superciety\ElrondSdk\Api\Endpoints\NetworkEndpoints;
use Superciety\ElrondSdk\Api\Endpoints\TokenEndpoints;

final class Api
{
    protected ?Carbon $cacheTtl = null;

    public function cacheFor(Carbon $ttl): self
    {
        $this->cacheTtl = $ttl;

        return $this;
    }

    public function accounts(): AccountEndpoints
    {
        return new AccountEndpoints($this->cacheTtl);
    }

    public function network(): NetworkEndpoints
    {
        return new NetworkEndpoints($this->cacheTtl);
    }

    public function blocks(): BlockEndpoints
    {
        return new BlockEndpoints($this->cacheTtl);
    }

    public function nfts(): NftEndpoints
    {
        return new NftEndpoints($this->cacheTtl);
    }

    public function tokens(): TokenEndpoints
    {
        return new TokenEndpoints($this->cacheTtl);
    }
}
