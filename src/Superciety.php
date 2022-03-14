<?php

namespace Superciety\ElrondSdk;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;

class Superciety
{
    const ApiBaseUrlMainnet = 'https://api.superciety.com';
    const ApiBaseUrlTestnet = 'https://staging-api.superciety.com';

    public static function getIdentity(string $address): array
    {
        return Http::get(static::getApiBaseUrl() . "/identity/{$address}")
                ->throw()
                ->json()['data'] ?? null;
    }

    public static function requireIdentityPowerOrThrow(string $address, int $minAmount): void
    {
        try {
            $power = static::getIdentity($address)['power'] ?? 0;

            if ($power >= $minAmount) {
                return;
            }
        } catch (RequestException $e) {
            Log::error("there might be something wrong with the identity power guard: {$e->getMessage()}", $e->getTrace());
        }

        throw ValidationException::withMessages([
            'power' => ["You must possess at least {$minAmount} superpower"],
        ]);
    }

    private static function getApiBaseUrl(): string
    {
        return match (config('elrond.chain_id')) {
            'D' => env('SCY_API_URL_DEVNET', self::ApiBaseUrlMainnet),
            'T' => self::ApiBaseUrlTestnet,
            '1' => self::ApiBaseUrlMainnet,
            default => throw new Exception('invalid chain id'),
        };
    }
}
