<?php

use Illuminate\Support\Str;
use Superciety\ElrondSdk\Domain\TransactionPayload;

it('contractCall - builds a contract call payload', function () {
    $actual = TransactionPayload::contractCall('doTest', [
        'arg2', 'arg1', 3,
    ]);

    expect($actual->data)
        ->toBe('doTest@61726732@61726731@03');
});

it('issueNonFungible - builds an nft token issue payload', function () {
    $actual = TransactionPayload::issueNonFungible('Testing', 'test', [
        'canFreeze', 'canPause', 'canTransferNFTCreateRole',
    ]);

    expect($actual->data)
        ->toBe('issueNonFungible@54657374696e67@54455354@63616e467265657a65@74727565@63616e5061757365@74727565@63616e5472616e736665724e4654437265617465526f6c65@74727565');
});

it('issueSemiFungible - builds an nft token issue payload', function () {
    $actual = TransactionPayload::issueSemiFungible('Testing', 'test', [
        'canFreeze', 'canPause', 'canTransferNFTCreateRole',
    ]);

    expect($actual->data)
        ->toBe('issueSemiFungible@54657374696e67@54455354@63616e467265657a65@74727565@63616e5061757365@74727565@63616e5472616e736665724e4654437265617465526f6c65@74727565');
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
        ->toBe('ESDTNFTCreate@534f4d452d31323334@01@536f6d65546f6b656e@04e2@787878414e5948415348787878@746167733a6f6e653b74776f3b6d657461646174613a78797a@68747470733a2f2f737570657263696574792e636f6d');
});

it('createNft - encodes for the correct royalties hex representation', function (float $percent, string $expectedHex) {
    $actual = TransactionPayload::createNft('xx-1234', 'xx', $percent, 'xx', [], ['https://any.com']);
    $royaltiesArgIndex = 4;

    expect(Str::of($actual->data)->explode('@')[$royaltiesArgIndex])
        ->toBe($expectedHex);
})
    ->with([
        [1.1, '6e'],
        [5, '01f4'],
        [9.99, '03e7'],
        [12.5, '04e2'],
        [50, '1388'],
        [80.75, '1f8b'],
        [100, '2710'],
    ]);

it('setNftRoles - builds an nft set special roles payload', function () {
    $actual = TransactionPayload::setNftRoles('SOME-1234', 'erd1qqqqqqqqqqqqqqqpqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqzllls8a5w6u', ['ESDTRoleNFTCreate', 'ESDTRoleNFTBurn']);

    expect($actual->data)
        ->toBe('setSpecialRole@534f4d452d31323334@000000000000000000010000000000000000000000000000000000000002ffff@45534454526f6c654e4654437265617465@45534454526f6c654e46544275726e');
});

it('burnNft - builds an nft burn payload', function () {
    $actual = TransactionPayload::burnNft('SOME-1234', 1);

    expect($actual->data)
        ->toBe('ESDTNFTBurn@534f4d452d31323334@01@01');
});
