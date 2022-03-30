<?php

use Superciety\ElrondSdk\Elrond;
use Superciety\ElrondSdk\Api\Entities\Nft;

it('gets an nft by id', function () {
    fakeApiRequestWithResponse('/nfts/MARSHM1-021222-74', 'nfts/nft.json');

    $actual = Elrond::api()
        ->nfts()
        ->getById('MARSHM1-021222-74');

    assertMatchesResponseSnapshot($actual);

    expect($actual)->toBeInstanceOf(Nft::class);
    expect($actual->attributes)->toBe("Background:white; skin:orange; contour:black; effect:half tone; accessories:dango");
    expect($actual->description)->toBe("test description");
    expect($actual->royalties)->toBe(8);
});

it('gets the owner accounts of an nft', function () {
    fakeApiRequestWithResponse('/nfts/SCYPERKS-025266-01/accounts', 'nfts/accounts.json');

    $actual = Elrond::api()
        ->nfts()
        ->getAccounts('SCYPERKS-025266-01');

    assertMatchesResponseSnapshot($actual);
});
