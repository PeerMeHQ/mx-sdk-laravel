<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\Elrond;

it('gets economics', function () {
    fakeApiRequestWithResponse('/economics', 'network/economics.json');

    $actual = Elrond::api()
        ->network()
        ->getEconomics();

    assertMatchesResponseSnapshot($actual);
});

it('gets constants', function () {
    fakeApiRequestWithResponse('/constants', 'network/constants.json');

    $actual = Elrond::api()
        ->network()
        ->getNetworkConstants();

    assertMatchesResponseSnapshot($actual);
});

it('gets mex pairs', function () {
    fakeApiRequestWithResponse('/mex-pairs', 'network/mex-pairs.json');

    $actual = Elrond::api()
        ->network()
        ->getMexPairs();

    assertMatchesResponseSnapshot($actual);
});
