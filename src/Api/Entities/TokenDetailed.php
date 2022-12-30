<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;
use Peerme\Multiversx\Domain\Address;

final class TokenDetailed
{
    use ApiTransformable;

    public function __construct(
        public string $identifier,
        public string $name,
        public string $ticker,
        public Address $owner,
        public int $decimals,
        public bool $isPaused,
        public ?TokenAssets $assets,
        public bool $canUpgrade,
        public bool $canMint,
        public bool $canBurn,
        public bool $canChangeOwner,
        public bool $canPause,
        public bool $canFreeze,
        public bool $canWipe,
        public string $supply,
        public ?string $minted = null,
        public ?string $burnt = null,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'owner' => Address::fromBech32($res['owner']),
            'assets' => isset($res['assets']) ? TokenAssets::fromApiResponse($res['assets']) : null,
        ])));
    }
}
