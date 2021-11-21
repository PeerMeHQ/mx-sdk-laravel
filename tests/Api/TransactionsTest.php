<?php

use Superciety\ElrondSdk\Elrond;

it('gets a transaction by transaction hash', function () {
    fakeApiRequestWithResponse('/transactions/anicehash', 'transactions/transaction.json');

    $actual = Elrond::api()
        ->transactions()
        ->getByHash('anicehash');

    assertMatchesResponseSnapshot($actual);
});
