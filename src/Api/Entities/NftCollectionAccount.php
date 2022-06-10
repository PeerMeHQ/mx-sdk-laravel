<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\ApiTransformable;
use Superciety\ElrondSdk\Domain\Address;

final class NftCollectionAccount
{
    use ApiTransformable;

    public function __construct(
        public string $collection,
        public string $type,
        public string $name,
        public string $ticker,
        public ?Address $owner = null,
        public bool $canFreeze = false,
        public bool $canWipe = false,
        public bool $canPause = false,
        public bool $canTransferNftCreateRole = false,
        /** @var \Superciety\ElrondSdk\Api\Entities\CollectionRoles */
        public Collection $roles = new Collection,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'owner' => isset($res['owner']) ? Address::fromBech32($res['owner']) : null,
            'roles' => isset($res['roles']) ? CollectionRoles::fromApiResponseMany($res['roles']) : collect(),
        ]);
    }
}
