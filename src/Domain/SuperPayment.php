<?php

namespace Superciety\ElrondSdk\Domain;

use Exception;
use Superciety\ElrondSdk\Domain\TokenPayment;

class SuperPayment extends TokenPayment
{
    const SuperTokenId = 'SUPER-507aa6';
    const SuperTokenIdTestnet = 'XSUPER-c19331';
    const SuperTokenIdDevnet = 'DSUPER-9af8df';
    const SuperNumDecimals = 18;

    public static function fromAmount(int|float $amount): SuperPayment
    {
        return static::fromBigInteger(static::toBigNumber($amount, static::SuperNumDecimals));
    }

    public static function fromBigInteger(string $amountAsBigInteger): SuperPayment
    {
        return new SuperPayment(static::getSuperTokenIdentifier(), 0, $amountAsBigInteger, static::SuperNumDecimals);
    }

    public static function getSuperTokenIdentifier(): string
    {
        return match (config('elrond.chain_id')) {
            'D' => static::SuperTokenIdDevnet,
            'T' => static::SuperTokenIdTestnet,
            '1' => static::SuperTokenId,
            default => throw new Exception('invalid chain id'),
        };
    }
}
