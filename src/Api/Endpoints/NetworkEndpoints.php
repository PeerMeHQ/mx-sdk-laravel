<?php

namespace Peerme\Multiversx\Api\Endpoints;

use Carbon\Carbon;
use Peerme\Multiversx\Api\EndpointBase;
use Peerme\Multiversx\Api\Entities\Economics;
use Peerme\Multiversx\Api\Entities\NetworkConstants;

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
}
