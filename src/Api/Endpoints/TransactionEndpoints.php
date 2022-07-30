<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\TransactionDetailed;
use Superciety\ElrondSdk\Api\Entities\TransactionSendResult;
use Superciety\ElrondSdk\Domain\Transaction;

class TransactionEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getByHash(string $txHash): TransactionDetailed
    {
        return TransactionDetailed::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/transactions/{$txHash}")
        );
    }

    public function send(Transaction $tx): TransactionSendResult
    {
        return TransactionSendResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/transactions", $tx->toSendable())
        );
    }
}
