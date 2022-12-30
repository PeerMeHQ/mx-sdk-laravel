<?php

namespace Peerme\Multiversx\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Peerme\Multiversx\Api\EndpointBase;
use Peerme\Multiversx\Api\Entities\MexPair;
use Peerme\Multiversx\Api\Entities\MexToken;

class MexEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getPairs(): Collection
    {
        return MexPair::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/mex/pairs")
        );
    }

    public function getTokens(): Collection
    {
        return MexToken::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/mex/tokens")
        );
    }
}
