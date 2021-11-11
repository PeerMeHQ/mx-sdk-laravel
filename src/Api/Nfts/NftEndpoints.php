<?php

namespace Superciety\ElrondSdk\Api\Nfts;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Nfts\Responses\Nft;

class NftEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getById(string $identifier): Nft
    {
        return Nft::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/nfts/{$identifier}", $this->cacheTtl, skipDataUnwrapping: true)
        );
    }
}
