<?php

namespace Peerme\Multiversx\Api\Entities;

use Illuminate\Support\Collection;
use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Api\ApiTransformable;

final class NftCollection
{
    use ApiTransformable;

    public function __construct(
        public string $collection,
        public string $type,
        public string $name,
        public string $ticker,
        public Address $owner,
        public bool $canFreeze = false,
        public bool $canWipe = false,
        public bool $canPause = false,
        public bool $canTransferNftCreateRole = false,
        /** @var \Peerme\Multiversx\Api\Entities\CollectionRoles */
        public Collection $roles = new Collection,
    ) {
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'owner' => Address::fromBech32($res['owner']),
            'roles' => isset($res['roles']) ? CollectionRoles::fromApiResponseMany($res['roles']) : collect(),
        ]);
    }
}
