<?php

namespace Superciety\ElrondSdk\Api\Network;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Network\Responses\Economics;
use Superciety\ElrondSdk\Api\Network\Responses\ShardStatus;
use Superciety\ElrondSdk\Api\Network\Responses\NetworkConfig;

final class NetworkEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getEconomics(): Economics
    {
        return Economics::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/network/economics", $this->cacheTtl)['metrics']
        );
    }

    public function getNetworkConfig(): NetworkConfig
    {
        return NetworkConfig::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/network/config", $this->cacheTtl)['config']
        );
    }

    public function getShardStatus(int $shardId): ShardStatus
    {
        return ShardStatus::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/network/status/{$shardId}", $this->cacheTtl)['status']
        );
    }
}
