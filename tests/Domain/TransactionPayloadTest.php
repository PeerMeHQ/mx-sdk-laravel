<?php

use Superciety\ElrondSdk\Domain\TransactionPayload;

it('issueNonFungible - builds a nft issue payload', function () {
    $attributes = [
        'tags' => ['one', 'two'],
        'metadata' => 'xyz',
    ];

    $uris = [
        'https://superciety.com',
    ];

    $actual = TransactionPayload::issueNonFungible('SOME-1234', 'SomeToken', 12.50, 'xxxANYHASHxxx', $attributes, $uris);

    expect($actual->data)
        ->toBe("ESDTNFTCreate@534f4d452d31323334@536f6d65546f6b656e@4688@787878414e5948415348787878@746167733a6f6e653b74776f3b6d657461646174613a78797a@68747470733a2f2f737570657263696574792e636f6d");
});

it('serializeAttributes - correctly serializes nft attributes', function () {
    $attriutes = [
        'tags' => ['nicetag', 'morenice', 'nicest'],
        'metadata' => 'xxxIxAmxMetadataxFromxEgxIPFSxxx',
    ];

    $actual = TransactionPayload::serializeAttributes($attriutes);

    expect($actual)
        ->toBe('tags:nicetag,morenice;nicest;metadata:xxxIxAmxMetadataxFromxEgxIPFSxxx');
});
