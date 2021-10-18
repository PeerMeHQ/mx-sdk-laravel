<?php

namespace Superciety\ElrondSdk\Api\Network;

use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Network\Responses\Economics;
use Superciety\ElrondSdk\Api\Network\Responses\ShardStatus;
use Superciety\ElrondSdk\Api\Network\Responses\NetworkConfig;

final class NetworkEndpoints extends EndpointBase
{
    public function __construct(
        private string $baseUrl
    ) {
    }

    public function getEconomics(): Economics
    {
        return Economics::fromResponse(
            static::request('GET', "{$this->baseUrl}/network/economics")['metrics']
        );
    }

    public function getNetworkConfig(): NetworkConfig
    {
        return NetworkConfig::fromResponse(
            static::request('GET', "{$this->baseUrl}/network/config")['config']
        );
    }

    public function getShardStatus(int $shardId): ShardStatus
    {
        return ShardStatus::fromResponse(
            static::request('GET', "{$this->baseUrl}/network/status/{$shardId}")['status']
        );
    }
}
