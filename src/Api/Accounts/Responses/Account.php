<?php

namespace Superciety\ElrondSdk\Api\Accounts\Responses;

use Superciety\ElrondSdk\Api\ResponseBase;

class Account extends ResponseBase
{
    public function __construct(
        public string $address,
        public int $nonce,
        public string $balance,
        public int $txCount,
        public int $shard,
        public ?string $username = null,
        public ?string $rootHash = null,
    ) {
    }
}
