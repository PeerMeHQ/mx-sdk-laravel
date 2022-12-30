<?php

namespace Peerme\Multiversx\Domain;

use Exception;
use Brick\Math\BigDecimal;
use Brick\Math\BigInteger;
use Peerme\Multiversx\Domain\TokenPayment;

class SuperPayment extends TokenPayment
{
    const SuperTokenId = 'SUPER-507aa6';
    const SuperTokenIdTestnet = 'XSUPER-c19331';
    const SuperTokenIdDevnet = 'DSUPER-9af8df';
    const SuperNumDecimals = 18;

    public static function fromAmount(int|float $amount): SuperPayment
    {
        $bigInteger = BigDecimal::of($amount)
            ->withPointMovedRight(static::SuperNumDecimals)
            ->toBigInteger();

        return static::fromBigInteger($bigInteger);
    }

    public static function fromBigInteger(BigInteger|string $amountAsBigInteger): SuperPayment
    {
        return new SuperPayment(static::getSuperTokenIdentifier(), 0, BigInteger::of($amountAsBigInteger), static::SuperNumDecimals);
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
