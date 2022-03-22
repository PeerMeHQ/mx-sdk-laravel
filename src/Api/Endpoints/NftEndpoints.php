<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Nft;
use Superciety\ElrondSdk\Api\Entities\NftOwner;

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

    public function getOwners(string $identifier, array $params = []): Collection
    {
        return NftOwner::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/nfts/{$identifier}/owners", $params)
        );
    }
}
