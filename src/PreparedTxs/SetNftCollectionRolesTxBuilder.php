<?php

namespace Superciety\ElrondSdk\PreparedTxs;

use InvalidArgumentException;
use Superciety\ElrondSdk\Domain\PreparedTx;
use Superciety\ElrondSdk\Domain\TransactionPayload;
use Superciety\ElrondSdk\PreparedTxs\IPreparedTxBuilder;

class SetNftCollectionRolesTxBuilder implements IPreparedTxBuilder
{
    public function build(array $input): PreparedTx
    {
        $collection = $input['collection'] ?? throw new InvalidArgumentException('collection is required');
        $address = $input['address'] ?? throw new InvalidArgumentException('address is required');
        $roles = $input['roles'] ?? throw new InvalidArgumentException('roles is required');

        return PreparedTx::setNftRoles(TransactionPayload::setNftRoles($collection, $address, $roles));
    }
}
