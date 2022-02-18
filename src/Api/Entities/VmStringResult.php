<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class VmStringResult
{
    use ApiTransformable;

    public function __construct(
        public string $data,
    ) {
    }
}
