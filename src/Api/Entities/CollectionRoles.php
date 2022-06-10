<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class CollectionRoles
{
    use ApiTransformable;

    public function __construct(
        public bool $canTransferRole = false,
        public bool $canCreate = false,
        public bool $canBurn = false,
    ) {
    }
}
