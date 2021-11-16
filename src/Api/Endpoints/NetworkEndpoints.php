<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Economics;
use Superciety\ElrondSdk\Api\Entities\NetworkConstants;

final class NetworkEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getEconomics(): Economics
    {
        return Economics::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/economics", $this->cacheTtl)
        );
    }

    public function getNetworkConstants(): NetworkConstants
    {
        return NetworkConstants::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/constants", $this->cacheTtl)
        );
    }
}
