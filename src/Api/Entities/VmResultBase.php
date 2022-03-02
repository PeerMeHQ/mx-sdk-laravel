<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

class VmResultBase
{
    use ApiTransformable;

    public function __construct(
        public $data,
    ) {
    }
}
