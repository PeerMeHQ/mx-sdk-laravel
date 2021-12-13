<?php

namespace Superciety\ElrondSdk\PreparedTxs;

use Superciety\ElrondSdk\Domain\PreparedTx;

interface IPreparedTxBuilder
{
    public function build(array $input): PreparedTx;
}
