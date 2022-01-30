<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class VmHexResult
{
    use ApiTransformable;

    public function __construct(
        public string $data,
    ) {
    }
}
