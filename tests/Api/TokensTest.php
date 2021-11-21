<?php

use Superciety\ElrondSdk\Elrond;

it('gets the transaction history of an NFT ', function () {
    fakeApiRequestWithResponse('/tokens/QUACK-f01e02-0259/transactions', 'tokens/transactions.json');

    $actual = Elrond::api()
        ->tokens()
        ->getTransactions('QUACK-f01e02-0259');

    assertMatchesResponseSnapshot($actual);
});
