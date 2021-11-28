<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

class TokenDetailedWithBalance
{
    use ApiTransformable;

    public function __construct(
        public string $identifier,
        public string $name,
        public string $ticker,
        public string $owner,
        public string $minted,
        public string $burnt,
        public int $decimals,
        public bool $isPaused,
        public ?TokenAssets $assets,
        public string $canUpgrade,
        public string $canMint,
        public string $canBurn,
        public string $canChangeOwner,
        public string $canPause,
        public string $canFreeze,
        public string $canWipe,
        public string $supply,
        public Balance $balance,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        $token = new Token($res['identifier'], $res['name'], $res['decimals']);

        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'assets' => isset($res['assets']) ? TokenAssets::fromApiResponse($res['assets']) : null,
            'balance' => Balance::from($token, $res['balance']),
        ])));
    }
}
