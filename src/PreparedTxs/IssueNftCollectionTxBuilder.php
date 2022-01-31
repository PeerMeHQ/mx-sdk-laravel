<?php

namespace Superciety\ElrondSdk\PreparedTxs;

use InvalidArgumentException;
use Superciety\ElrondSdk\Domain\PreparedTx;
use Illuminate\Validation\ValidationException;
use Superciety\ElrondSdk\Domain\TransactionPayload;
use Superciety\ElrondSdk\PreparedTxs\IPreparedTxBuilder;

class IssueNftCollectionTxBuilder implements IPreparedTxBuilder
{
    public function build(array $input): PreparedTx
    {
        $type = $input['type'] ?? throw ValidationException::withMessages(['collection' => 'type is required']);
        $name = $input['name'] ?? throw ValidationException::withMessages(['collection' => 'name is required']);
        $ticker = $input['ticker'] ?? throw ValidationException::withMessages(['collection' => 'ticker is required']);
        $properties = $input['properties'] ?? throw ValidationException::withMessages(['collection' => 'properties are required']);

        return PreparedTx::issueNonFungible(match ($type) {
            'NonFungibleESDT' => TransactionPayload::issueNonFungible($name, $ticker, $properties),
            'SemiFungibleESDT' => TransactionPayload::issueSemiFungible($name, $ticker, $properties),
            default => throw new InvalidArgumentException("invalid type '{$type}'"),
        });
    }
}
