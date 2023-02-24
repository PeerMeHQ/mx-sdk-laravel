<?php

use Peerme\MxLaravel\Auth\NativeAuthDecoded;
use Peerme\MxLaravel\Auth\NativeAuthServer;

beforeEach(function () {
    $this->address = 'erd1kc7v0lhqu0sclywkgeg4um8ea5nvch9psf2lf8t96j3w622qss8sav2zl8';
    $this->signature = '1f384391dd1d17dfb75307fff47bcce05aa1a2a2034089d4ea0c54757895c63520169cc5d6eb4414a1b77abfd185655c13bb5a4233eecf258b64ed05dde36c0d';
    $this->blockHash = '591a3cf6fc0d083179f18640e7c63e2b6a0711f95b9d67910bc525139fce106d';
    $this->ttl = 86_400;
    $this->accessToken = 'ZXJkMWtjN3YwbGhxdTBzY2x5d2tnZWc0dW04ZWE1bnZjaDlwc2YybGY4dDk2ajN3NjIycXNzOHNhdjJ6bDg.ZUdWNFkyaGhibWRsTG1OdmJRLjU5MWEzY2Y2ZmMwZDA4MzE3OWYxODY0MGU3YzYzZTJiNmEwNzExZjk1YjlkNjc5MTBiYzUyNTEzOWZjZTEwNmQuODY0MDAuZXlKMGFXMWxjM1JoYlhBaU9qRTJOemN5T0RBeU16Wjk.1f384391dd1d17dfb75307fff47bcce05aa1a2a2034089d4ea0c54757895c63520169cc5d6eb4414a1b77abfd185655c13bb5a4233eecf258b64ed05dde36c0d';
    $this->blockTimestamp = 1671009408;
    $this->origin = 'xexchange.com';
    $this->nativeServerConfig = [
        'acceptedOrigins' => ['https://xexchange.com'],
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

it('throws if invalid signature in access token', function () {
    $subject = new NativeAuthServer(...$this->nativeServerConfig);

    $subject->validate($this->accessToken.'abcdef');
})
    ->expectExceptionMessage('invalid signature');

it('throws if invalid origin', function () {
    $subject = new NativeAuthServer(...[
        ...$this->nativeServerConfig,
        'acceptedOrigins' => ['other-origin'],
    ]);

    $subject->validate($this->accessToken);
})
    ->expectExceptionMessage('invalid origin');
