<?php

use Brick\Math\BigInteger;
use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Domain\Transaction;
use Peerme\Multiversx\Domain\TransactionPayload;
use Peerme\Multiversx\Domain\UserSigner;

const AliceAddress = 'erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th';
const BobAddress = 'erd1spyavw0956vq68xj8y4tenjpq2wd5a9p2c6j8gsz7ztyrnpxrruqzu66jx';
const MinGasLimit = 50000;
const MinGasPrice = 1000000000;

const AlicePem = "-----BEGIN PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----
NDEzZjQyNTc1ZjdmMjZmYWQzMzE3YTc3ODc3MTIxMmZkYjgwMjQ1ODUwOTgxZTQ4
YjU4YTRmMjVlMzQ0ZThmOTAxMzk0NzJlZmY2ODg2NzcxYTk4MmYzMDgzZGE1ZDQy
MWYyNGMyOTE4MWU2Mzg4ODIyOGRjODFjYTYwZDY5ZTE=
-----END PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----";

it('hashes without data and without value', function () {
    $tx = new Transaction(
        nonce: 89,
        value: BigInteger::zero(),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: MinGasLimit,
        chainID: 'local-testnet',
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('B56769014F2BDC5CF9FC4A05356807D71FCF8775C819B0F1B0964625B679C918FFA64862313BFEF86F99B38CB84FCDB16FA33AD6EB565276616723405CD8F109');
});

it('hashes with data and no value', function () {
    $tx = new Transaction(
        nonce: 90,
        value: BigInteger::zero(),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: 80000,
        data: new TransactionPayload("hello"),
        chainID: 'local-testnet',
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('E47FD437FC17AC9A69F7BF5F85BAFA9E7628D851C4F69BD9FEDC7E36029708B2E6D168D5CD652EA78BEEDD06D4440974CA46C403B14071A1A148D4188F6F2C0D');
});

it('hashes with data and with opaque and unused options the protocol ignores the options when version is 1', function () {
    $tx = new Transaction(
        nonce: 89,
        value: BigInteger::zero(),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: MinGasLimit,
        chainID: 'local-testnet',
        version: 1,
        options: 1,
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('C83E69B853A891BF2130C1839362FE2A7A8DB327DCC0C9F130497A4F24B0236140B394801BB2E04CE061A6F873CB432BF1BB1E6072E295610904662AC427A30A');
});

it('with data and with value', function () {
    $tx = new Transaction(
        nonce: 91,
        value: BigInteger::of('10000000000000000000'),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: 100000,
        data: new TransactionPayload("for the book"),
        chainID: 'local-testnet',
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('9074789E0B4F9B2AC24B1FD351A4DD840AFCFEB427B0F93E2A2D429C28C65EE9F4C288CA4DBDE79DE0E5BCF8C1A5D26E1B1C86203FAEA923E0EDEFB0B5099B0C');
});

it('with data and with large value', function () {
    $tx = new Transaction(
        nonce: 92,
        value: BigInteger::of('123456789000000000000000000000'),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: 100000,
        data: new TransactionPayload("for the spaceship"),
        chainID: 'local-testnet',
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('39938D15812708475DFC8125B5D41DBCEA0B2E3E7AABBBFCEB6CE4F070DE3033676A218B73FACD88B1432D7D4ACCAB89C6130B3ABE5CC7BBBB5146E61D355B03');
});

it('with nonce = 0', function () {
    $tx = new Transaction(
        nonce: 0,
        value: BigInteger::zero(),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: 80000,
        data: new TransactionPayload("hello"),
        chainID: 'local-testnet',
        version: 1,
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('DFA3E9F2FDEC60DCB353BAC3B3435B4A2FF251E7E98EAF8620F46C731FC70C8BA5615FD4E208B05E75FE0F7DC44B7A99567E29F94FCD91EFAC7E67B182CD2A04');
});

it('without options field should be omitted', function () {
    $tx = new Transaction(
        nonce: 89,
        value: BigInteger::zero(),
        sender: Address::fromBech32(AliceAddress),
        receiver: Address::fromBech32(BobAddress),
        gasPrice: MinGasPrice,
        gasLimit: MinGasLimit,
        chainID: 'local-testnet',
    );

    UserSigner::fromPem(AlicePem)->sign($tx);

    expect($tx->signature->hex())
        ->toBe('B56769014F2BDC5CF9FC4A05356807D71FCF8775C819B0F1B0964625B679C918FFA64862313BFEF86F99B38CB84FCDB16FA33AD6EB565276616723405CD8F109');
});
