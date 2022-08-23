<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Nft;
use Superciety\ElrondSdk\Api\Entities\NftCollection;

class CollectionEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getById(string $identifier, array $params = []): NftCollection
    {
        return NftCollection::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/collections/{$identifier}", $params)
        );
    }

    public function getNftsById(string $identifier, array $params = []): Collection
    {
        return Nft::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/collections/{$identifier}/nfts", $params)
        );
    }
}
