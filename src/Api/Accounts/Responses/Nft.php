<?php

namespace Superciety\ElrondSdk\Api\Accounts\Responses;

use Superciety\ElrondSdk\Api\ResponseBase;

class Nft extends ResponseBase
{
    const NonFungibleESDT = 'NonFungibleESDT';
    const SemiFungibleESDT = 'SemiFungibleESDT';
    const MetaESDT = 'MetaESDT';

    public function __construct(
        public string $identifier,
        public string $collection,
        public string $attributes,
        public int $nonce,
        public string $type,
        public string $name,
        public string $creator,
        public string $ticker,
        public ?int $royalties = null,
        public ?string $url = null,
        public ?string $thumbnailUrl = null,
    ) {
    }
}
