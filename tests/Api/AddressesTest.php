<?php

use Superciety\ElrondSdk\Elrond;

it('gets an address', function () {
    fakeApiRequestWithResponse('/addresses/erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', 'addresses/address.json');

    $actual = Elrond::api()
        ->addresses()
        ->getAddress('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc');

    assertMatchesResponseSnapshot($actual);
});
