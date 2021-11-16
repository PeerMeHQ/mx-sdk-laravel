<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ResponseBase;

final class NetworkConstants extends ResponseBase
{
    public function __construct(
        public string $chainId,
        public int $gasPerDataByte,
        public int $minGasLimit,
        public int $minGasPrice,
        public int $minTransactionVersion,
    ) {
    }
}
