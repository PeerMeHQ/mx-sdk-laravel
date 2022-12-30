<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

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
