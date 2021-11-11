<?php

namespace Superciety\ElrondSdk\Api\Accounts;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Accounts\Responses\Nft;
use Superciety\ElrondSdk\Api\Accounts\Responses\Account;

class AccountEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getByAddress(string $address): Account
    {
        return Account::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/accounts/{$address}", $this->cacheTtl, skipDataUnwrapping: true)
        );
    }

    public function getNfts(string $address, array $types = []): Collection
    {
        $types = implode(',', $types);

        return Nft::fromApiResponseMany(
            static::request('GET', "{$this->getApiBaseUrl()}/accounts/{$address}/nfts?type={$types}", $this->cacheTtl, skipDataUnwrapping: true)
        );
    }
}
