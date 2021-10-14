<?php

namespace Superciety\ElrondSdk\Addresses\Responses;

use Superciety\ElrondSdk\ResponseBase;

class Address extends ResponseBase
{
    public function __construct(
        public string $address,
        public int $nonce,
        public string $balance,
        public string $rootHash,
        public int $txCount,
        public string $username,
        public int $shard,
    ) {
    }
}
