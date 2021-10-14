<?php

namespace Superciety\ElrondSdk\Addresses;

use Superciety\ElrondSdk\EndpointBase;
use Superciety\ElrondSdk\Addresses\Responses\Address;

class AddressEndpoints extends EndpointBase
{
    public function __construct(
        private string $baseUrl
    ) {
    }

    public function getAddress(string $address): Address
    {
        return Address::fromResponse(
            static::request('GET', "{$this->baseUrl}/addresses/{$address}", skipDataUnwrapping: true)
        );
    }
}
