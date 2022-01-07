<?php

use Superciety\ElrondSdk\PreparedTxs\IssueNftCollectionTxBuilder;

it('builds a nft collection issue tx', function () {
    $input = [
        'type' => 'nft',
        'name' => 'Test1',
        'ticker' => 'Test2',
        'properties' => ['canFreeze', 'canWipe'],
    ];

    $actual = (new IssueNftCollectionTxBuilder)
        ->build($input);

    expect($actual->data->data)
        ->toBe('issueNonFungible@5465737431@5445535432@63616e467265657a65@74727565@63616e57697065@74727565');
});

it('builds a sft collection issue tx', function () {
    $input = [
        'type' => 'sft',
        'name' => 'Test1',
        'ticker' => 'Test2',
        'properties' => ['canFreeze', 'canWipe'],
    ];

    $actual = (new IssueNftCollectionTxBuilder)
        ->build($input);

    expect($actual->data->data)
        ->toBe('issueSemiFungible@5465737431@5445535432@63616e467265657a65@74727565@63616e57697065@74727565');
});
