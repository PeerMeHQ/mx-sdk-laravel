<?php

use Peerme\Multiversx\Elrond;

it('gets a transaction by transaction hash', function () {
    fakeApiRequestWithResponse('/transactions/01b94cb36f027bab9391414971c7feb348755c53f8ea27f19c18fb82db35ea7d', 'transactions/transaction.json');

    $actual = Elrond::api()
        ->transactions()
        ->getByHash('01b94cb36f027bab9391414971c7feb348755c53f8ea27f19c18fb82db35ea7d');

    assertMatchesResponseSnapshot($actual);
});
