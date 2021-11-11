<?php

namespace Superciety\ElrondSdk\Api;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\Nfts\NftEndpoints;
use Superciety\ElrondSdk\Api\Blocks\BlockEndpoints;
use Superciety\ElrondSdk\Api\Network\NetworkEndpoints;
use Superciety\ElrondSdk\Api\Accounts\AccountEndpoints;

final class Api
{
    private ?Carbon $cacheTtl = null;

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
}
