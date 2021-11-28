<?php

namespace Superciety\ElrondSdk\Domain;

class TransactionPayload
{
    public function __construct(
        public string $data,
    ) {
    }

    public static function issueNonFungible(string $token, string $name, int|float $royalties, string $hash, array $attributes, array $uris): TransactionPayload
    {
        $urisHex = collect($uris)
            ->map(fn (string $uri) => bin2hex(trim($uri)))
            ->all();

        $data = collect(['ESDTNFTCreate'])
            ->push(bin2hex(mb_strtoupper($token)))
            ->push(bin2hex($name))
            ->push((string) hexdec($royalties <= 100 ? $royalties * 100 : $royalties))
            ->push(bin2hex($hash))
            ->push(bin2hex(static::serializeAttributes($attributes)))
            ->push(...$urisHex)
            ->join('@');

        return new TransactionPayload($data);
    }

    public function toBase64(): string
    {
        return base64_encode($this->data);
    }

    public static function serializeAttributes(array $attributes): string
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
