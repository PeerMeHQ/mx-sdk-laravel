<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Utils\Encoder;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Domain\VmHexResult;
use Superciety\ElrondSdk\Domain\VmQueryResult;

class VmEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function query(string $contractAddress, string $func, array $args = [], array $params = []): VmQueryResult
    {
        return VmQueryResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/vm-values/query", [
                'scAddress' => $contractAddress,
                'funcName' => $func,
                'args' => collect($args)->map(fn ($a) => Encoder::toHex($a))->all(),
                ...$params,
            ], unwrapData: true)
        );
    }

    public function hex(string $contractAddress, string $func, array $args = [], array $params = []): VmHexResult
    {
        return VmHexResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/vm-values/hex", [
                'scAddress' => $contractAddress,
                'funcName' => $func,
                'args' => collect($args)->map(fn ($a) => Encoder::toHex($a))->all(),
                ...$params,
            ], unwrapData: true)
        );
    }
}
