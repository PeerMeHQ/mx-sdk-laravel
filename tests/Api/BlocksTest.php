<?php


use Peerme\Multiversx\Elrond;

it('gets blocks', function () {
    fakeApiRequestWithResponse('/blocks', 'blocks/blocks.json');

    $actual = Elrond::api()
        ->blocks()
        ->getBlocks();

    assertMatchesResponseSnapshot($actual);
});

it('gets a hyperblock by nonce', function () {
    fakeApiRequestWithResponse('/hyperblock/by-nonce/12345', 'blocks/hyperblock_by_nonce.json');

    $actual = Elrond::api()
        ->blocks()
        ->getHyperblockByNonce('12345');

    assertMatchesResponseSnapshot($actual);
});

it('gets a hyperblock by hash', function () {
    fakeApiRequestWithResponse('/hyperblock/by-hash/d6f029c04b84cc1fcda318cb309c89974369f0af735a6de9d9ef35d15c5169c1', 'blocks/hyperblock_by_hash.json');

    $actual = Elrond::api()
        ->blocks()
        ->getHyperblockByHash('d6f029c04b84cc1fcda318cb309c89974369f0af735a6de9d9ef35d15c5169c1');

    assertMatchesResponseSnapshot($actual);
});
