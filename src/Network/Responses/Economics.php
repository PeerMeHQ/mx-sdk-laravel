<?php

namespace Superciety\ElrondSdk\Network\Responses;

use Superciety\ElrondSdk\ResponseBase;

final class Economics extends ResponseBase
{
    public function __construct(
        public string $erd_dev_rewards,
        public int $erd_epoch_for_economics_data,
        public string $erd_inflation,
        public string $erd_total_base_staked_value,
        public string $erd_total_fees,
        public string $erd_total_supply,
        public string $erd_total_top_up_value,
    ) {
    }
}
