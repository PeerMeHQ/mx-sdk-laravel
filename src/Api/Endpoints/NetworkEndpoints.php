<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\MexPair;
use Superciety\ElrondSdk\Api\Entities\Economics;
use Superciety\ElrondSdk\Api\Entities\NetworkConstants;

final class NetworkEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getEconomics(): Economics
    {
        return Economics::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/economics")
        );
    }

    public function getNetworkConstants(): NetworkConstants
    {
        return NetworkConstants::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/constants")
        );
    }

    public function getMexPairs(): Collection
    {
        return MexPair::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/mex-pairs")
        );
    }
}
