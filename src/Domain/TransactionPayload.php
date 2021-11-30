<?php

namespace Superciety\ElrondSdk\Domain;

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

    public static function createNft(string $token, string $name, int|float $royalties, string $hash, array $attributes, array $uris): TransactionPayload
    {
        $data = collect(['ESDTNFTCreate'])
            ->push(bin2hex(mb_strtoupper($token)))
            ->push(bin2hex($name))
            ->push((string) hexdec($royalties <= 100 ? $royalties * 100 : $royalties))
            ->push(bin2hex($hash))
            ->push(bin2hex(static::serializeNftAttributes($attributes)))
            ->push(...collect($uris)
                ->map(fn (string $uri) => bin2hex(trim($uri)))
                ->all())
            ->filter()
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
        $serializeAttribute = fn (array $attribute) => collect($attribute)->map(fn (string $a) => trim($a))->join(',', ';');

        $attributes = collect($attributes)
            ->map(function (string|array $attribute, string $name) use ($serializeAttribute) {
                return $name . ':' . (is_string($attribute) ? trim($attribute) : $serializeAttribute($attribute));
            })
            ->join(';');

        return rtrim($attributes, ';');
    }
}
