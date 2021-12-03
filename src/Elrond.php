<?php

namespace Superciety\ElrondSdk;

use Throwable;
use Superciety\ElrondSdk\Api\Api;
use Superciety\ElrondSdk\Crypto\Crypto;
use Superciety\ElrondSdk\Domain\Balance;
use Superciety\ElrondSdk\Ipfs\IProvider;
use Illuminate\Validation\ValidationException;

final class Elrond
{
    public static function api(): Api
    {
        return new Api();
    }

    public static function crypto(): Crypto
    {
        return new Crypto();
    }

    public static function ipfs(): IProvider
    {
        return new (config('elrond.ipfs.provider'));
    }

    public static function requireAccountTokenOwnershipOrThrow(string $address, Balance $minimumBalance): void
    {
        try {
            $hasSufficientBalance = static::api()
            ->cacheFor(now()->addSeconds(30))
            ->accounts()
            ->getToken($address, $minimumBalance->token->identifier)
            ->balance
            ->isEqualOrMoreThan($minimumBalance);

            if ($hasSufficientBalance) {
                return;
            }
        } catch (Throwable) {
        }

        throw ValidationException::withMessages([
            'balance' => ["You must hold at least {$minimumBalance->toDenominated()} \${$minimumBalance->token->name} tokens."],
        ]);
    }
}
