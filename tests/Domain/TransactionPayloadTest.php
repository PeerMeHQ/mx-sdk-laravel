<?php

use Superciety\ElrondSdk\Domain\TransactionPayload;

it('issueNonFungible - builds an nft token issue payload', function () {
    $actual = TransactionPayload::issueNonFungible('Testing', 'test', [
        'canFreeze', 'canPause', 'canTransferNFTCreateRole',
    ]);

    expect($actual->data)
        ->toBe("issueNonFungible@54657374696e67@54455354@63616e467265657a65@74727565@63616e5061757365@74727565@63616e5472616e736665724e4654437265617465526f6c65@74727565");
});

it('issueSemiFungible - builds an nft token issue payload', function () {
    $actual = TransactionPayload::issueSemiFungible('Testing', 'test', [
        'canFreeze', 'canPause', 'canTransferNFTCreateRole',
    ]);

    expect($actual->data)
        ->toBe("issueSemiFungible@54657374696e67@54455354@63616e467265657a65@74727565@63616e5061757365@74727565@63616e5472616e736665724e4654437265617465526f6c65@74727565");
});

it('createNft - builds an nft issue payload', function () {
    $attributes = [
        'tags' => ['one', 'two'],
        'metadata' => 'xyz',
    ];

    $uris = [
        'https://superciety.com',
    ];

    $actual = TransactionPayload::createNft('SOME-1234', 'SomeToken', 12.50, 'xxxANYHASHxxx', $attributes, $uris);

    expect($actual->data)
        ->toBe("ESDTNFTCreate@534f4d452d31323334@01@536f6d65546f6b656e@4e2@787878414e5948415348787878@746167733a6f6e653b74776f3b6d657461646174613a78797a@68747470733a2f2f737570657263696574792e636f6d");
});
