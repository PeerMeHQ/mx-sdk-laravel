<?php

namespace Superciety\ElrondSdk\PreparedQueries;

use Superciety\ElrondSdk\Domain\VmQueryResult;

interface IVmQueryBuilder
{
    public function build(array $input): VmQueryResult;
}
