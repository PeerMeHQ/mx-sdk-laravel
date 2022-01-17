<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class TokenDetailed
{
    use ApiTransformable;

    public function __construct(
        public string $identifier,
        public string $name,
        public string $ticker,
        public string $owner,
        public string $minted,
        public Balance $burnt,
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
        public Balance $supply,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        $token = new Token($res['identifier'], $res['name'], $res['decimals']);

        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'assets' => isset($res['assets']) ? TokenAssets::fromApiResponse($res['assets']) : null,
            'burnt' => Balance::from($token, $res['burnt']),
            'supply' => Balance::from($token, $res['supply']),
        ])));
    }
}
