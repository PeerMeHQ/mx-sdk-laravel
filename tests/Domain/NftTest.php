<?php

use Superciety\ElrondSdk\Api\Entities\Nft;

it('getTags - returns all tags given in attributes', function () {
    $nft = makeTestNftWithHumanReadableAttributes('tags:tag1,tag2,tag3;metadata:xxxx_ipfs_content_iD_xxxx');

    $actual = $nft->getTags();

    expect($actual)->toContain('tag1', 'tag2', 'tag3');
});

it('getTags - returns an empty array if no tags given', function () {
    $nft = makeTestNftWithHumanReadableAttributes('tags:;metadata:QmQU4JJgNMuQ4SLpJrY76rK7Tmpdv3dnskD3fhzJWwDkeV');

    $actual = $nft->getTags();

    expect($actual)->toBeEmpty();
});

it('getIpfsContentId - returns an ipfs content id', function () {
    $nft = makeTestNftWithHumanReadableAttributes('tags:tag1,tag2,tag3;metadata:xxxx_ipfs_content_iD_xxxx');

    $actual = $nft->getIpfsContentId();

    expect($actual)->toBe('xxxx_ipfs_content_iD_xxxx');
});

function makeTestNftWithHumanReadableAttributes(string $attributes)
{
    return new Nft(
        identifier: 'id',
        collection: 'xyz',
        attributes: $attributes,
        nonce: '01',
        type: 'irrelevant',
        name: 'name',
        creator: 'erd1creator',
        ticker: 'ticker',
        royalties: 10,
        url: 'https://irrelevant',
        thumbnailUrl: 'https://irrelevant',
    );
}
