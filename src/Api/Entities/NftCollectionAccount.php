<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class NftCollectionAccount
{
    use ApiTransformable;

    public function __construct(
        public string $collection,
        public string $type,
        public string $name,
        public string $ticker,
        public bool $canFreeze,
        public bool $canWipe,
        public bool $canPause,
        public bool $canTransferRole,
        public bool $canCreate,
        public bool $canBurn,
    ) {
    }
}
