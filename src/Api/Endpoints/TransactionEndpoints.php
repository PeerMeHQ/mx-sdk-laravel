<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Domain\Transaction;

class TransactionEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getByHash(string $txHash): Transaction
    {
        return Transaction::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/transactions/{$txHash}")
        );
    }
}
