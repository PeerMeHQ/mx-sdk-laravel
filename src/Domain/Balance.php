<?php

namespace Superciety\ElrondSdk\Domain;

use InvalidArgumentException;

final class Balance
{
    private function __construct(
        public Token $token,
        public string $amount,
    ) {
    }

    public static function from(Token $token, string|int|float $amount): static
    {
        return new static(
            token: $token,
            amount: static::fixPrecision($amount, $token),
        );
    }

    public static function egld(string|int|float $amount): static
    {
        return new static(
            token: Token::egld(),
            amount: static::fixPrecision($amount, Token::egld()),
        );
    }

    public static function super(string|int|float $amount): static
    {
        return new static(
            token: Token::super(),
            amount: static::fixPrecision($amount, Token::super()),
        );
    }

    public function plus(Balance $other): Balance
    {
        $this->assertSameToken($other);
        $this->amount = bcadd($this->amount, $other->amount);
        return $this;
    }

    public function minus(Balance $other): Balance
    {
        $this->assertSameToken($other);
        $this->amount = bcsub($this->amount, $other->amount);
        return $this;
    }

    public function isMoreThan(Balance $other): bool
    {
        $this->assertSameToken($other);
        return bccomp($this->amount, $other->amount) === 1;
    }

    public function isEqualOrMoreThan(Balance $other): bool
    {
        $this->assertSameToken($other);
        $result = bccomp($this->amount, $other->amount);
        return  $result === 0 || $result === 1;
    }

    public function isLessThan(Balance $other): bool
    {
        $this->assertSameToken($other);
        return bccomp($this->amount, $other->amount) === -1;
    }

    public function isEqualOrLessThan(Balance $other): bool
    {
        $this->assertSameToken($other);
        $result = bccomp($this->amount, $other->amount);
        return  $result === 0 || $result === -1;
    }

    public function toDenominated(?int $decimals = null): string
    {
        $formatted = substr_replace($this->amount, '.', -$this->token->decimals, 0);
        $formatted = str_starts_with($formatted, '.') ? '0' . $formatted : $formatted;
        $base = explode('.', $formatted)[0] ?? '';
        $formatted = $decimals !== null ? substr($formatted, 0, strlen($base) + 1 + $decimals) : $formatted;
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, '.');

        return $formatted;
    }

    private static function fixPrecision(string|int|float $amount, Token $token): string
    {
        $amountStr = (string) $amount;

        if (str_contains($amountStr, '.')) {
            $parts = explode('.', $amountStr);
            $decimals = str_pad($parts[1], $token->decimals, '0');
            return $parts[0] . $decimals;
        }

        if (is_string($amount) && strlen($amountStr) >= $token->decimals) {
            return $amountStr;
        }

        return str_pad($amountStr, strlen($amountStr) + $token->decimals, '0');
    }

    private function assertSameToken(Balance $other): void
    {
        if ($this->token->identifier !== $other->token->identifier) {
            throw new InvalidArgumentException("balance token '{$this->token->id}' does not match token '{$other->token->id}'.");
        }
    }
}
