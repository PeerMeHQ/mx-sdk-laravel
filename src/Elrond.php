<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Api\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Superciety\ElrondSdk\Crypto\Crypto;
use Superciety\ElrondSdk\Domain\Balance;
use Superciety\ElrondSdk\Ipfs\IProvider;
use Illuminate\Http\Client\RequestException;
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
        } catch (RequestException $e) {
            if ($e->getCode() === 400) {
                return;
            }

            Log::error("there might be something wrong with the account token guard: {$e->getMessage()}", $e->getTrace());
        }

        throw ValidationException::withMessages([
            'balance' => ["You must hold at least {$minimumBalance->toDenominated()} \${$minimumBalance->token->name} tokens."],
        ]);
    }

    public static function fakeApiResponseWith(array $responses): void
    {
        $getResponseFilePath = fn ($file) => base_path("vendor/superciety/elrond-sdk-laravel/tests/Api/responses/{$file}");

        Http::fake(collect($responses)
            ->mapWithKeys(fn ($resFile, $resEndpoint) => [
                $resEndpoint => Http::response(file_get_contents($getResponseFilePath($resFile)))
            ])
            ->all());
    }
}
