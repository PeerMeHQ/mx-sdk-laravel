<?php

namespace Superciety\ElrondSdk\PreparedQueries;

use Superciety\ElrondSdk\Api\Entities\VmResultBase;

interface IVmQuery
{
    public function execute(array $input, $user): VmResultBase;
}
