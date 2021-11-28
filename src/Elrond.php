<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Api\Api;
use Superciety\ElrondSdk\Crypto\Crypto;
use Superciety\ElrondSdk\Domain\Balance;
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

    public static function requireAccountTokenOwnershipOrThrow(string $address, Balance $minimumBalance): void
    {
        $hasSufficientBalance = static::api()
            ->cacheFor(now()->addSeconds(30))
            ->accounts()
            ->getToken($address, $minimumBalance->token->identifier)
            ->balance
            ->isEqualOrMoreThan($minimumBalance);

        if (!$hasSufficientBalance) {
            throw ValidationException::withMessages([
                'balance' => ["You must hold a minimum of {$minimumBalance->toDenominated()} {$minimumBalance->token->name} to perform this action."],
            ]);
        }
    }
}
