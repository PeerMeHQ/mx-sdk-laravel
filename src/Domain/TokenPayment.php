<?php

namespace Superciety\ElrondSdk\Domain;

use InvalidArgumentException;

class TokenPayment
{
    const EGLDTokenIdentifier = 'EGLD';
    const EGLDNumDecimals = 18;

    public function __construct(
        public readonly string $tokenIdentifier,
        public readonly int $nonce,
        public string $amountAsBigInteger,
        public readonly int $numDecimals,
    ) {
    }

    public static function egldFromAmount(int|float $amount): TokenPayment
    {
        return static::egldFromBigInteger(static::toBigNumber($amount, static::EGLDNumDecimals));
    }

    public static function egldFromBigInteger(string $amountAsBigInteger): TokenPayment
    {
        return new TokenPayment(static::EGLDTokenIdentifier, 0, $amountAsBigInteger, static::EGLDNumDecimals);
    }

    public static function fungibleFromAmount(string $tokenIdentifier, int|float $amount, int $numDecimals): TokenPayment
    {
        return static::fungibleFromBigInteger($tokenIdentifier, static::toBigNumber($amount, $numDecimals), $numDecimals);
    }

    public static function fungibleFromBigInteger(string $tokenIdentifier, string $amountAsBigInteger, int $numDecimals = 0): TokenPayment
    {
        return new TokenPayment($tokenIdentifier, 0, $amountAsBigInteger, $numDecimals);
    }

    public static function nonFungible(string $tokenIdentifier, int $nonce): TokenPayment
    {
        return new TokenPayment($tokenIdentifier, $nonce, 1, 0);
    }

    public static function semiFungible(string $tokenIdentifier, int $nonce, int $quantity)
    {
        return new TokenPayment($tokenIdentifier, $nonce, $quantity, 0);
    }

    public static function metaEsdtFromAmount(string $tokenIdentifier, int $nonce, int|float $amount, int $numDecimals): TokenPayment
    {
        return static::metaEsdtFromBigInteger($tokenIdentifier, $nonce, static::toBigNumber($amount, $numDecimals), $numDecimals);
    }

    public static function metaEsdtFromBigInteger(string $tokenIdentifier, int $nonce, string $amountAsBigInteger, int $numDecimals = 0)
    {
        return new TokenPayment($tokenIdentifier, $nonce, $amountAsBigInteger, $numDecimals);
    }

    public function toDenominated(?int $decimals = null, bool $formatted = false): string
    {
        $denominated = $this->numDecimals === 0
            ? $this->amountAsBigInteger
            : rtrim(rtrim(substr_replace($this->amountAsBigInteger, '.', -$this->numDecimals, 0), '0'), '.');

        $denominated = str_starts_with($denominated, '.') ? "0{$denominated}" : $denominated;

        if ($formatted || empty($denominated)) {
            return number_format((float) $denominated);
        }

        return $decimals !== null && str_contains($denominated, '.')
            ? rtrim(substr($denominated, 0, strpos($denominated, '.') + 1 + $decimals), '.')
            : $denominated;
    }

    public function toFloat(?int $decimals = null): float
    {
        $phpMaxDecPrecision = 14;

        return (float) $this->toDenominated($decimals ?? $phpMaxDecPrecision);
    }

    public function toInt(): int
    {
        return (int) $this->toDenominated(0);
    }

    public function isEgld()
    {
        return $this->tokenIdentifier == static::EGLDTokenIdentifier;
    }

    public function isFungible()
    {
        return $this->nonce == 0;
    }

    public function plus(TokenPayment $other): TokenPayment
    {
        $this->assertSameToken($other);
        $this->amountAsBigInteger = bcadd($this->amountAsBigInteger, $other->amountAsBigInteger);
        return $this;
    }

    public function minus(TokenPayment $other): TokenPayment
    {
        $this->assertSameToken($other);
        $this->amountAsBigInteger = bcsub($this->amountAsBigInteger, $other->amountAsBigInteger);
        return $this;
    }

    public function times(TokenPayment $other): TokenPayment
    {
        $this->assertSameToken($other);
        $this->amountAsBigInteger = bcmul($this->amountAsBigInteger, $other->amountAsBigInteger);
        return $this;
    }

    public function div(TokenPayment $other): TokenPayment
    {
        $this->assertSameToken($other);
        $this->amountAsBigInteger = bcdiv($this->amountAsBigInteger, $other->amountAsBigInteger);
        return $this;
    }

    public function isGreaterThan(TokenPayment $other): bool
    {
        $this->assertSameToken($other);
        return bccomp($this->amountAsBigInteger, $other->amountAsBigInteger) === 1;
    }

    public function isGreaterThanOrEqualTo(TokenPayment $other): bool
    {
        $this->assertSameToken($other);
        $result = bccomp($this->amountAsBigInteger, $other->amountAsBigInteger);
        return  $result === 0 || $result === 1;
    }

    public function isLessThan(TokenPayment $other): bool
    {
        $this->assertSameToken($other);
        return bccomp($this->amountAsBigInteger, $other->amountAsBigInteger) === -1;
    }

    public function isLessThanOrEqualTo(TokenPayment $other): bool
    {
        $this->assertSameToken($other);
        $result = bccomp($this->amountAsBigInteger, $other->amountAsBigInteger);
        return  $result === 0 || $result === -1;
    }

    protected static function toBigNumber(string|int|float $amount, int $decimals): string
    {
        $amountStr = (string) $amount;

        if (str_contains($amountStr, '.')) {
            $parts = explode('.', $amountStr);
            $decimals = str_pad($parts[1], $decimals, '0');
            return $parts[0] . $decimals;
        }

        if (is_string($amount) && $amountStr !== '0') {
            return $amountStr;
        }

        return str_pad($amountStr, strlen($amountStr) + $decimals, '0');
    }

    protected function assertSameToken(TokenPayment $other): void
    {
        if ($this->tokenIdentifier !== $other->tokenIdentifier) {
            throw new InvalidArgumentException("token '{$this->tokenIdentifier}' does not match token '{$other->tokenIdentifier}'");
        }
    }
}
