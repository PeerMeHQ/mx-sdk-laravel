<?php

use Peerme\Multiversx\Domain\UserSecretKey;

it('fromPem - parses a user secret key from pem', function () {
    $alicePem = "-----BEGIN PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----
    NDEzZjQyNTc1ZjdmMjZmYWQzMzE3YTc3ODc3MTIxMmZkYjgwMjQ1ODUwOTgxZTQ4
    YjU4YTRmMjVlMzQ0ZThmOTAxMzk0NzJlZmY2ODg2NzcxYTk4MmYzMDgzZGE1ZDQy
    MWYyNGMyOTE4MWU2Mzg4ODIyOGRjODFjYTYwZDY5ZTE=
    -----END PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----";

    $actual = UserSecretKey::fromPem($alicePem);

    expect($actual->key)->toBe('413f42575f7f26fad3317a778771212fdb80245850981e48b58a4f25e344e8f9');
});

it('fromPem - should throw if bad data', function () {
    $alicePem = "-----BEGIN PRIVATE KEY for alice
    NDEzZjQyNTc1ZjdmMjZmYWQzMzE3YTc3ODc3MTIxMmZkYjgwMjQ1ODUwOTgxZTQ4
    YjU4YTRmMjVlMzQ0ZThmOTAxMzk0NzJlZmY2ODg2NzcxYTk4MmYzMDgzZGE1ZDQy
    MWYyNGMyOTE4MWU2Mzg4ODIyOGRjODFjYTYwZDY5ZTE=";

    UserSecretKey::fromPem($alicePem);
})->expectExceptionMessage('incorrect file structure');
