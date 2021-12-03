<?php

namespace Superciety\ElrondSdk\Domain;

use Exception;

final class Token
{
    const SuperTokenId = 'SUPER-764d8d';
    const SuperTokenIdTestnet = 'XSUPER-72a15d';
    const SuperTokenIdDevnet = 'XSUPER-d0da40';

    public function __construct(
        public string $identifier,
        public string $name,
        public int $decimals,
    ) {
    }

    public static function egld(): static
    {
        return new static(identifier: 'EGLD', name: 'eGold', decimals: 18);
    }

    public static function super(): static
    {
        $tokenId = match (config('elrond.chain_id')) {
            'D' => static::SuperTokenIdDevnet,
            'T' => static::SuperTokenIdTestnet,
            '1' => static::SuperTokenId,
            default => throw new Exception('invalid chain id'),
        };

        return new static(identifier: $tokenId, name: 'SUPER', decimals: 0);
    }
}
