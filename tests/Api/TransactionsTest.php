<?php

use Superciety\ElrondSdk\Elrond;

it('gets a transaction by transaction hash', function () {
    fakeApiRequestWithResponse('/transactions/7a25e0f453a3cfe5e05b97f6c8e160028b98bb41fa0f932cff837d9f1fcad500', 'transactions/transaction.json');

    $actual = Elrond::api()
        ->transactions()
        ->getByHash('7a25e0f453a3cfe5e05b97f6c8e160028b98bb41fa0f932cff837d9f1fcad500');

    assertMatchesResponseSnapshot($actual);
});
