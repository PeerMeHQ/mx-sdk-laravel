<?php

namespace Peerme\Multiversx\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Peerme\Multiversx\Api\EndpointBase;
use Peerme\Multiversx\Api\Entities\Nft;
use Peerme\Multiversx\Api\Entities\NftOwner;

class NftEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getById(string $identifier): Nft
    {
        return Nft::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/nfts/{$identifier}")
        );
    }

    public function getAccounts(string $identifier, array $params = []): Collection
    {
        return NftOwner::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/nfts/{$identifier}/accounts", $params)
        );
    }
}
