<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Transaction;

class TokenEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getTransactions(string $tokenId): Collection
    {
        return Transaction::fromApiResponseMany(
            static::request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/transactions", $this->cacheTtl)
        );
    }
}
