<?php

use Superciety\ElrondSdk\Elrond;
use Superciety\ElrondSdk\Api\Entities\NftCollection;

it('gets a collection by id', function () {
    fakeApiRequestWithResponse('/collections/VNFT-507997', 'collections/collection.json');

    $actual = Elrond::api()
        ->collections()
        ->getById('VNFT-507997');

    assertMatchesResponseSnapshot($actual);

    expect($actual)->toBeInstanceOf(NftCollection::class);
});
