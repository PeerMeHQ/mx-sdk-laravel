<?php

namespace Peerme\Multiversx\Api\Endpoints;

use Carbon\Carbon;
use Peerme\Multiversx\Api\EndpointBase;
use Peerme\Multiversx\Api\Entities\TransactionDetailed;
use Peerme\Multiversx\Api\Entities\TransactionSendResult;
use Peerme\Multiversx\Domain\Transaction;

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
