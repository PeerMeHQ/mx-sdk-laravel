<?php

use Superciety\ElrondSdk\Elrond;
use Superciety\ElrondSdk\Api\Accounts\Responses\Nft;

it('gets an account by address', function () {
    fakeApiRequestWithResponse('/accounts/erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', 'accounts/account.json');

    $actual = Elrond::api()
        ->accounts()
        ->getByAddress('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc');

    assertMatchesResponseSnapshot($actual);
});

it('gets an accounts nfts', function () {
    fakeApiRequestWithResponse('/accounts/erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc/nfts*', 'accounts/nfts.json');

    $actual = Elrond::api()
        ->accounts()
        ->getNfts('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc');

    assertMatchesResponseSnapshot($actual);

    expect($actual[0])->toBeInstanceOf(Nft::class);
    expect($actual[0]->attributes)->toBe("description:POWERED BY ELROND NETWORK"); // to be base64 decoded
});
