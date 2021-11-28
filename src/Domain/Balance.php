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

    public function plus(Balance $other): void
    {
        $this->assertSameToken($other);
        $this->amount = bcadd($this->amount, $other->amount);
    }

    public function minus(Balance $other): void
    {
        $this->assertSameToken($other);
        $this->amount = bcsub($this->amount, $other->amount);
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
        $amount = (string) $amount;

        if (str_contains($amount, '.')) {
            $parts = explode('.', $amount);
            $decimals = str_pad($parts[1], $token->decimals, '0');
            return $parts[0] . $decimals;
        }

        if (strlen($amount) >= $token->decimals) {
            return $amount;
        }

        return str_pad($amount, strlen($amount) + $token->decimals, '0');
    }

    private function assertSameToken(Balance $other): void
    {
        if ($this->token->identifier !== $other->token->identifier) {
            throw new InvalidArgumentException("balance token '{$this->token->id}' does not match token '{$other->token->id}'.");
        }
    }
}
