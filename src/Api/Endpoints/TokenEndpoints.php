<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Transaction;
use Superciety\ElrondSdk\Api\Entities\TokenAccount;
use Superciety\ElrondSdk\Api\Entities\TokenDetailed;
use Superciety\ElrondSdk\Api\Entities\TokenAddressRoles;

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

    public function getAccounts(string $tokenId, array $params = []): Collection
    {
        return TokenAccount::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/accounts", $params)
        );
    }

    public function getAccountsCount(string $tokenId): int
    {
        return (int) $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/accounts/count");
    }

    public function getTransactions(string $tokenId, array $params = []): Collection
    {
        return Transaction::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/transactions", $params)
        );
    }

    public function getRoles(string $tokenId, array $params = []): Collection
    {
        return TokenAddressRoles::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/tokens/{$tokenId}/roles", $params)
        );
    }
}
