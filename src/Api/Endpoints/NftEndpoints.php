<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Domain\Nft;
use Superciety\ElrondSdk\Api\EndpointBase;

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
}
