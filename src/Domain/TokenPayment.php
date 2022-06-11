<?php

namespace Superciety\ElrondSdk\Domain;

use Brick\Math\BigDecimal;
use Brick\Math\BigInteger;
use Brick\Math\RoundingMode;

class TokenPayment
{
    const EGLDTokenIdentifier = 'EGLD';
    const EGLDNumDecimals = 18;

    protected function __construct(
        public readonly string $tokenIdentifier,
        public readonly int $nonce,
        public BigInteger $amountAsBigInteger,
        public readonly int $numDecimals,
    ) {
    }

    public static function egldFromAmount(int|float $amount): TokenPayment
    {
        $bigInteger = BigDecimal::of($amount)
            ->withPointMovedRight(static::EGLDNumDecimals)
            ->toBigInteger();

        return static::egldFromBigInteger($bigInteger);
    }

    public static function egldFromBigInteger(BigInteger|string $amountAsBigInteger): TokenPayment
    {
        return new TokenPayment(static::EGLDTokenIdentifier, 0, BigInteger::of($amountAsBigInteger), static::EGLDNumDecimals);
    }

    public static function fungibleFromAmount(string $tokenIdentifier, int|float $amount, int $numDecimals): TokenPayment
    {
        $bigInteger = BigDecimal::of($amount)
            ->withPointMovedRight($numDecimals)
            ->toBigInteger();

        return static::fungibleFromBigInteger($tokenIdentifier, $bigInteger, $numDecimals);
    }

    public static function fungibleFromBigInteger(string $tokenIdentifier, BigInteger|string $amountAsBigInteger, int $numDecimals = 0): TokenPayment
    {
        return new TokenPayment($tokenIdentifier, 0, BigInteger::of($amountAsBigInteger), $numDecimals);
    }

    public static function nonFungible(string $tokenIdentifier, int $nonce): TokenPayment
    {
        return new TokenPayment($tokenIdentifier, $nonce, BigInteger::one(), 0);
    }

    public static function semiFungible(string $tokenIdentifier, int $nonce, int $quantity)
    {
        return new TokenPayment($tokenIdentifier, $nonce, BigInteger::of($quantity), 0);
    }

    public static function metaEsdtFromAmount(string $tokenIdentifier, int $nonce, int|float $amount, int $numDecimals): TokenPayment
    {
        $bigInteger = BigDecimal::of($amount)
            ->withPointMovedRight($numDecimals)
            ->toBigInteger();

        return static::metaEsdtFromBigInteger($tokenIdentifier, $nonce, $bigInteger, $numDecimals);
    }

    public static function metaEsdtFromBigInteger(string $tokenIdentifier, int $nonce, BigInteger|string $amountAsBigInteger, int $numDecimals = 0)
    {
        return new TokenPayment($tokenIdentifier, $nonce, BigInteger::of($amountAsBigInteger), $numDecimals);
    }

    public function toDenominated(?int $decimals = null, bool $formatted = false): string
    {
        $float = $this->amountAsBigInteger
            ->toBigDecimal()
            ->withPointMovedLeft($this->numDecimals)
            ->toScale($decimals ?? 12, RoundingMode::DOWN)
            ->toFloat();

        return $formatted ? number_format($float) : $float;
    }

    public function isEgld()
    {
        return $this->tokenIdentifier === static::EGLDTokenIdentifier;
    }

    public function isFungible()
    {
        return $this->nonce === 0;
    }

    public function toInt(): int
    {
        return (int) $this->toDenominated(0);
    }
}
