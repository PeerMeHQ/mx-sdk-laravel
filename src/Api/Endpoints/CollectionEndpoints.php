<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\NftCollection;

class CollectionEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getById(string $identifier): NftCollection
    {
        return NftCollection::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/collections/{$identifier}")
        );
    }
}
