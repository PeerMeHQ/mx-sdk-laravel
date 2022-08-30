<?php

use Superciety\ElrondSdk\Elrond;

it('gets mex pairs', function () {
    fakeApiRequestWithResponse('/mex/pairs', 'mex/pairs.json');

    $actual = Elrond::api()
        ->mex()
        ->getPairs();

    assertMatchesResponseSnapshot($actual);
});

it('gets mex tokens', function () {
    fakeApiRequestWithResponse('/mex/tokens', 'mex/tokens.json');

    $actual = Elrond::api()
        ->mex()
        ->getTokens();

    assertMatchesResponseSnapshot($actual);
});
