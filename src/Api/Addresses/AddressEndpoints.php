<?php

namespace Superciety\ElrondSdk\Api\Addresses;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Addresses\Responses\Address;

class AddressEndpoints extends EndpointBase
{
    public function __construct(
        private string $baseUrl,
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getAddress(string $address): Address
    {
        return Address::fromResponse(
            static::request('GET', "{$this->baseUrl}/addresses/{$address}", $this->cacheTtl, skipDataUnwrapping: true)
        );
    }
}
