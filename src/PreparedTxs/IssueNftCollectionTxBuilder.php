<?php

namespace Superciety\ElrondSdk\PreparedTxs;

use InvalidArgumentException;
use Superciety\ElrondSdk\Domain\PreparedTx;
use Superciety\ElrondSdk\Domain\TransactionPayload;
use Superciety\ElrondSdk\PreparedTxs\IPreparedTxBuilder;

class IssueNftCollectionTxBuilder implements IPreparedTxBuilder
{
    public function build(array $input): PreparedTx
    {
        $type = $input['type'] ?? throw new InvalidArgumentException('type is required');
        $name = $input['name'] ?? throw new InvalidArgumentException('name is required');
        $ticker = $input['ticker'] ?? throw new InvalidArgumentException('ticker is required');
        $properties = $input['properties'] ?? throw new InvalidArgumentException('properties is required');

        return PreparedTx::issueNonFungible(match ($type) {
            'nft' => TransactionPayload::issueNonFungible($name, $ticker, $properties),
            'sft' => TransactionPayload::issueSemiFungible($name, $ticker, $properties),
            default => throw new InvalidArgumentException('invalid type'),
        });
    }
}
