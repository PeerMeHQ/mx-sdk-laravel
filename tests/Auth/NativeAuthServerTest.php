<?php

use Peerme\Mx\Address;
use Peerme\Mx\SignableMessage;
use Peerme\Mx\Signature;
use Peerme\Mx\UserSigner;
use Peerme\MxLaravel\Auth\NativeAuthDecoded;
use Peerme\MxLaravel\Auth\NativeAuthServer;
use Peerme\MxLaravel\Exceptions\NativeAuthInvalidSignatureException;
use Peerme\MxLaravel\Exceptions\NativeAuthOriginNotAcceptedException;
use Peerme\MxLaravel\Exceptions\NativeAuthTokenExpiredException;

beforeEach(function () {
    $alicePem = '-----BEGIN PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----
    NDEzZjQyNTc1ZjdmMjZmYWQzMzE3YTc3ODc3MTIxMmZkYjgwMjQ1ODUwOTgxZTQ4
    YjU4YTRmMjVlMzQ0ZThmOTAxMzk0NzJlZmY2ODg2NzcxYTk4MmYzMDgzZGE1ZDQy
    MWYyNGMyOTE4MWU2Mzg4ODIyOGRjODFjYTYwZDY5ZTE=
    -----END PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----';

    $signer = UserSigner::fromPem($alicePem);
    $address = 'erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th';
    $blockHash = '591a3cf6fc0d083179f18640e7c63e2b6a0711f95b9d67910bc525139fce106d';
    $ttl = 86_400;
    $origin = 'api.multiversx.com';
    $init = rtrim(base64_encode($origin), '=').'.'.$blockHash.'.'.$ttl.'.'.'e30';

    $signature = $signer->sign((new SignableMessage(
        message: $address.$init,
        signature: new Signature(''),
        address: Address::zero(),
    ))->serializeForSigning())->hex();

    $this->address = $address;
    $this->signature = $signature;
    $this->blockHash = $blockHash;
    $this->ttl = $ttl;
    $this->accessToken = rtrim(base64_encode($this->address), '=').'.'.rtrim(base64_encode($init), '=').'.'.$signature;
    $this->blockTimestamp = 1671009408;
    $this->origin = $origin;
    $this->nativeServerConfig = [
        'acceptedOrigins' => [$origin],
        'maxExpirySeconds' => 86_400,
        'apiUrl' => 'https://api.multiversx.com',
    ];
});

it('decodes an access token', function () {
    $subject = new NativeAuthServer(...$this->nativeServerConfig);

    $actual = $subject->decode($this->accessToken);

    expect($actual)->toBeInstanceOf(NativeAuthDecoded::class);
    expect($actual->address)->toBe($this->address);
    expect($actual->signature)->toBe($this->signature);
    expect($actual->blockHash)->toBe($this->blockHash);
    expect($actual->ttl)->toBe($this->ttl);
    expect($actual->origin)->toBe($this->origin);
});

it('validates an access token', function () {
    $subject = new NativeAuthServer(...$this->nativeServerConfig);

    $actual = $subject->validate($this->accessToken);

    expect($actual->address)->toBe($this->address);
});

it('throws when invalid signature in access token', function () {
    $subject = new NativeAuthServer(...$this->nativeServerConfig);

    $subject->validate($this->accessToken.'abcdef');
})
    ->expectException(NativeAuthInvalidSignatureException::class);

it('throws when invalid origin', function () {
    $subject = new NativeAuthServer(...[
        ...$this->nativeServerConfig,
        'acceptedOrigins' => ['other-origin'],
    ]);

    $subject->validate($this->accessToken);
})
    ->expectException(NativeAuthOriginNotAcceptedException::class);

it('throws when extra info timestamp exceeds ttl', function () {
    $subject = new NativeAuthServer(...[
        ...$this->nativeServerConfig,
        'acceptedOrigins' => ['localhost'],
    ]);

    $subject->validate('ZXJkMXdqeXRmbjZ6aHFmY3NlanZod3Y3cTR1c2F6czVyeWMzajhoYzc4ZmxkZ2pueWN0OHdlanFrYXN1bmM.Ykc5allXeG9iM04wLjE4YmM5ODI0NjFkMWI1M2M4MzdhMjRkZTRiNDYyM2MyYmI4MzU4NjdlYTJlOGRmMTQzNjVjZjQzNmRlZTFiMjMuNjAwLmV5SjBhVzFsYzNSaGJYQWlPakUyTnpNNU56SXpOalI5.f8d651eda06e82a894ff1dc9480a33aa1030b076dfd5983346eec6793381587b88c2daf770a10ac39f9911968c2f1d1304c0c7dd86a82bc79f07e89f873f7e02');
})
    ->expectException(NativeAuthTokenExpiredException::class);
