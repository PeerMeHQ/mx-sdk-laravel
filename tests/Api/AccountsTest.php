<?php

use Superciety\ElrondSdk\Elrond;

it('gets an account by address', function () {
    fakeApiRequestWithResponse('/accounts/erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', 'accounts/account.json');

    $actual = Elrond::api()
        ->accounts()
        ->getByAddress('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc');

    assertMatchesResponseSnapshot($actual);
});
