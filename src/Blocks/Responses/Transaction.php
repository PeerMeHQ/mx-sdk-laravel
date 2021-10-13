<?php

namespace Superciety\ElrondSdk\Blocks\Responses;

use Superciety\ElrondSdk\ResponseBase;

final class Transaction extends ResponseBase
{
    public function __construct(
        public string $type,
        public string $hash,
        public int $nonce,
        public string $value,
        public string $receiver,
        public string $sender,
        public int $gasPrice,
        public int $gasLimit,
        public string $data,
        public string $signature,
        public string $status,
    ) {
    }
}
