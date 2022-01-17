<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Domain\Transaction;
use Superciety\ElrondSdk\Domain\TokenDetailed;

class TokenEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getById(string $tokenId): TokenDetailed
    {
        return TokenDetailed::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}")
        );
    }

    public function getAccountsCount(string $tokenId): int
    {
        return (int) $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/accounts/count");
    }

    public function getTransactions(string $tokenId): Collection
    {
        return Transaction::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/transactions")
        );
    }
}
