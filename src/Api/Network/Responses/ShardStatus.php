<?php

namespace Superciety\ElrondSdk\Api\Network\Responses;

use Superciety\ElrondSdk\Api\ResponseBase;

final class ShardStatus extends ResponseBase
{
    public function __construct(
        public int $erd_current_round,
        public int $erd_epoch_number,
        public int $erd_highest_final_nonce,
        public int $erd_nonce,
        public int $erd_nonce_at_epoch_start,
        public int $erd_nonces_passed_in_current_epoch,
        public int $erd_round_at_epoch_start,
        public int $erd_rounds_passed_in_current_epoch,
        public int $erd_rounds_per_epoch,
    ) {
    }
}
