<?php

namespace Superciety\ElrondSdk\Network\Responses;

use Superciety\ElrondSdk\ResponseBase;

final class NetworkConfig extends ResponseBase
{
    public function __construct(
        public string $erd_chain_id,
        public int $erd_denomination,
        public int $erd_gas_per_data_byte,
        public string $erd_gas_price_modifier,
        public string $erd_latest_tag_software_version,
        public int $erd_meta_consensus_group_size,
        public int $erd_min_gas_limit,
        public int $erd_min_gas_price,
        public int $erd_min_transaction_version,
        public int $erd_num_metachain_nodes,
        public int $erd_num_nodes_in_shard,
        public int $erd_num_shards_without_meta,
        public string $erd_rewards_top_up_gradient_point,
        public int $erd_round_duration,
        public int $erd_rounds_per_epoch,
        public int $erd_shard_consensus_group_size,
        public int $erd_start_time,
        public string $erd_top_up_factor,
    ) {
    }
}
