<?php

namespace Peerme\Multiversx\Domain;

use Peerme\Multiversx\Utils\Encoder;
use Peerme\Multiversx\Domain\Address;

final class TransactionPayload
{
    public function __construct(
        public string $data,
    ) {
    }

    public static function contractCall(string $func, array $args = []): TransactionPayload
    {
        $encodedArgs = collect($args)
            ->map(fn ($arg) => Encoder::toHex($arg))
            ->filter();

        return $encodedArgs->isNotEmpty()
            ? new TransactionPayload("{$func}@{$encodedArgs->join('@')}")
            : new TransactionPayload($func);
    }

    public static function superToContractTransfer(int $superAmount, string $functionName, array $args): TransactionPayload
    {
        $payment = SuperPayment::fromAmount($superAmount);

        $data = collect(['ESDTTransfer'])
            ->push(Encoder::toHex($payment->tokenIdentifier))
            ->push(Encoder::toHex($payment->amountAsBigInteger))
            ->push(Encoder::toHex($functionName))
            ->push(...collect($args)->map(fn ($arg) => Encoder::toHex($arg))->all())
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function issueNonFungible(string $name, string $ticker, array $properties = []): TransactionPayload
    {
        $data = collect(['issueNonFungible'])
            ->push(Encoder::toHex($name))
            ->push(Encoder::toHex(strtoupper($ticker)))
            ->push(static::serializeTokenProperties($properties))
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function issueSemiFungible(string $name, string $ticker, array $properties = []): TransactionPayload
    {
        $data = collect(['issueSemiFungible'])
            ->push(Encoder::toHex($name))
            ->push(Encoder::toHex(strtoupper($ticker)))
            ->push(static::serializeTokenProperties($properties))
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function createNft(string $collection, string $name, float $royalties, string $hash, array $attributes, array $uris, int $quantity = 1): TransactionPayload
    {
        $data = collect(['ESDTNFTCreate'])
            ->push(Encoder::toHex($collection))
            ->push(Encoder::toHex($quantity))
            ->push(Encoder::toHex($name))
            ->push(Encoder::toHex($royalties * 100))
            ->push(Encoder::toHex($hash))
            ->push(static::serializeNftAttributes($attributes))
            ->push(...collect($uris)
                ->map(fn (string $uri) => Encoder::toHex($uri))
                ->all())
            ->filter()
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function setNftRoles(string $collection, string $address, array $roles): TransactionPayload
    {
        $data = collect(['setSpecialRole'])
            ->push(bin2hex($collection))
            ->push(Address::fromBech32($address)->hex())
            ->push(...collect($roles)
                ->map(fn (string $role) => Encoder::toHex($role))
                ->all())
            ->join('@');

        return new TransactionPayload($data);
    }

    public static function burnNft(string $collection, int $nonce): TransactionPayload
    {
        $data = collect(['ESDTNFTBurn'])
            ->push(Encoder::toHex($collection))
            ->push(Encoder::toHex($nonce))
            ->push(Encoder::toHex(1))
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
            ->map(fn ($p) => Encoder::toHex($p) . '@' .  Encoder::toHex('true'))
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

        return Encoder::toHex(rtrim($attributes, ';'));
    }
}
