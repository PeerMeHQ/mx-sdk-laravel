<?php

namespace Superciety\ElrondSdk\Network;

use Superciety\ElrondSdk\EndpointBase;
use Superciety\ElrondSdk\Network\Responses\Economics;

final class NetworkEndpoints extends EndpointBase
{
    public function __construct(
        private string $baseUrl
    ) {
    }

    public function getEconomics(): Economics
    {
        return Economics::fromResponse(
            static::request('GET', "{$this->baseUrl}/economics")
        );
    }
}
