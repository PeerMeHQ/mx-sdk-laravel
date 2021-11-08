<?php

namespace Superciety\ElrondSdk\Api\Accounts;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Accounts\Responses\Account;

class AccountEndpoints extends EndpointBase
{
    public function __construct(
        private string $baseUrl,
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getByAddress(string $address): Account
    {
        return Account::fromResponse(
            static::request('GET', "{$this->baseUrl}/accounts/{$address}", $this->cacheTtl, skipDataUnwrapping: true)
        );
    }
}
