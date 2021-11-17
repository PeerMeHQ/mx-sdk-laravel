<?php

namespace Superciety\ElrondSdk\Domain;

class Balance
{
    private function __construct(
        public Token $token,
        public string $amount,
    ) {
    }

    public static function from(Token $token, string $amount): static
    {
        return new static(
            token: $token,
            amount: static::fixPrecision($amount, $token),
        );
    }

    public static function egld(string $amount): static
    {
        return new static(
            token: Token::egld(),
            amount: static::fixPrecision($amount, Token::egld()),
        );
    }

    public function toDenominated(): string
    {
        $formatted = substr_replace($this->amount, '.', -$this->token->decimals, 0);

        return str_starts_with($formatted, '.')
            ? '0' . $formatted
            : $formatted;
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
}
