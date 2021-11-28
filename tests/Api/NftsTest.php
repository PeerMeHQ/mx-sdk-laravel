<?php

use Superciety\ElrondSdk\Elrond;
use Superciety\ElrondSdk\Domain\Nft;

it('gets an nft by id', function () {
    fakeApiRequestWithResponse('/nfts/MARSHM1-021222-74', 'nfts/nft.json');

    $actual = Elrond::api()
        ->nfts()
        ->getById('MARSHM1-021222-74');

    assertMatchesResponseSnapshot($actual);

    expect($actual)->toBeInstanceOf(Nft::class);
    expect($actual->attributes)->toBe("Background:white; skin:orange; contour:black; effect:half tone; accessories:dango");
});
