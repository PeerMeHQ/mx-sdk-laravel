<?php

namespace Peerme\Multiversx\Api;

use Carbon\Carbon;
use Peerme\Multiversx\Api\Endpoints\AccountEndpoints;
use Peerme\Multiversx\Api\Endpoints\BlockEndpoints;
use Peerme\Multiversx\Api\Endpoints\CollectionEndpoints;
use Peerme\Multiversx\Api\Endpoints\MexEndpoints;
use Peerme\Multiversx\Api\Endpoints\NetworkEndpoints;
use Peerme\Multiversx\Api\Endpoints\NftEndpoints;
use Peerme\Multiversx\Api\Endpoints\TokenEndpoints;
use Peerme\Multiversx\Api\Endpoints\TransactionEndpoints;
use Peerme\Multiversx\Api\Endpoints\VmEndpoints;

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

    public function collections(): CollectionEndpoints
    {
        return new CollectionEndpoints($this->cacheTtl);
    }

    public function mex(): MexEndpoints
    {
        return new MexEndpoints($this->cacheTtl);
    }

    public function nfts(): NftEndpoints
    {
        return new NftEndpoints($this->cacheTtl);
    }

    public function tokens(): TokenEndpoints
    {
        return new TokenEndpoints($this->cacheTtl);
    }

    public function transactions(): TransactionEndpoints
    {
        return new TransactionEndpoints($this->cacheTtl);
    }

    public function vm(): VmEndpoints
    {
        return new VmEndpoints($this->cacheTtl);
    }
}
