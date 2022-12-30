<?php

use Peerme\Multiversx\Domain\UserSigner;

it('sign - signs a message using pem', function () {
    $alicePem = "-----BEGIN PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----
    NDEzZjQyNTc1ZjdmMjZmYWQzMzE3YTc3ODc3MTIxMmZkYjgwMjQ1ODUwOTgxZTQ4
    YjU4YTRmMjVlMzQ0ZThmOTAxMzk0NzJlZmY2ODg2NzcxYTk4MmYzMDgzZGE1ZDQy
    MWYyNGMyOTE4MWU2Mzg4ODIyOGRjODFjYTYwZDY5ZTE=
    -----END PRIVATE KEY for erd1qyu5wthldzr8wx5c9ucg8kjagg0jfs53s8nr3zpz3hypefsdd8ssycr6th-----";

    $message = bin2hex('something');

    $subject = UserSigner::fromPem($alicePem);

    $actual = $subject->sign($message);

    expect($actual->hex())
        ->toBe('84F5F14B50A0FB4301030E731EEC1804334B5ECAC6C9CAE946218B462A02AA64A825D7B561D7FCD323CECFAE2DD24040C134C6008747A36061A47CE69DE4F50B');
});
