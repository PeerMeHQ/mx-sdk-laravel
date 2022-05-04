<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Domain\Token;
use Superciety\ElrondSdk\Domain\Balance;
use Superciety\ElrondSdk\Api\ApiTransformable;

final class TokenDetailedWithBalance
{
    use ApiTransformable;

    public function __construct(
        public string $identifier,
        public string $name,
        public string $owner,
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
        public Balance $balance,
        public ?string $ticker = null,
        public ?string $burnt = null,
        public ?string $minted = null,
        public ?string $supply = null,
    ) {
    }

    public static function fromApiResponse(array $res): static
    {
        $token = new Token($res['identifier'], $res['name'], $res['decimals']);

        return new static(...static::filterUnallowedProperties(array_merge($res, [
            'assets' => isset($res['assets']) ? TokenAssets::fromApiResponse($res['assets']) : null,
            'balance' => Balance::from($token, $res['balance'] ?? 0),
        ])));
    }
}
