<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Elrond;

final class TransactionPayload
{
    public function __construct(
        public string $data,
    ) {
    }

    public static function issueNonFungible(string $name, string $ticker, array $properties = []): TransactionPayload
    {
        $data = collect(['issueNonFungible'])
            ->push(bin2hex($name))
            ->push(bin2hex(mb_strtoupper($ticker)))
            ->push(static::serializeTokenProperties($properties))
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function issueSemiFungible(string $name, string $ticker, array $properties = []): TransactionPayload
    {
        $data = collect(['issueSemiFungible'])
            ->push(bin2hex($name))
            ->push(bin2hex(mb_strtoupper($ticker)))
            ->push(static::serializeTokenProperties($properties))
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function createNft(string $collection, string $name, int|float $royalties, string $hash, array $attributes, array $uris): TransactionPayload
    {
        $data = collect(['ESDTNFTCreate'])
            ->push(bin2hex($collection))
            ->push('01')
            ->push(bin2hex($name))
            ->push((string) dechex($royalties <= 100 ? $royalties * 100 : $royalties))
            ->push(bin2hex($hash))
            ->push(bin2hex(static::serializeNftAttributes($attributes)))
            ->push(...collect($uris)
                ->map(fn (string $uri) => bin2hex(trim($uri)))
                ->all())
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function setNftRoles(string $collection, string $address, array $roles): TransactionPayload
    {
        $data = collect(['setSpecialRole'])
            ->push(bin2hex($collection))
            ->push(Elrond::crypto()->convertAddressBech32ToHex($address))
            ->push(...collect($roles)
                ->map(fn (string $role) => bin2hex(trim($role)))
                ->all())
            ->join('@');

        return new TransactionPayload($data);
    }

    public function toBase64(): string
    {
        return base64_encode($this->data);
    }

    private static function serializeTokenProperties(array $properties): string
    {
        return collect($properties)
            ->filter()
            ->map(fn ($p) => bin2hex($p) . '@' .  bin2hex('true'))
            ->join('@');
    }

    private static function serializeNftAttributes(array $attributes): string
    {
        $serializeAttribute = fn (array $attribute) => collect($attribute)
            ->map(fn (?string $a) => $a !== null ? trim($a) : null)
            ->filter()
            ->join(',', ';');

        $attributes = collect($attributes)
            ->filter()
            ->map(function (string|array $attribute, string $name) use ($serializeAttribute) {
                return $name . ':' . (is_string($attribute) ? trim($attribute) : $serializeAttribute($attribute));
            })
            ->join(';');

        return rtrim($attributes, ';');
    }
}
