<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Utils\Encoder;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\VmHexResult;
use Superciety\ElrondSdk\Api\Entities\VmIntResult;
use Superciety\ElrondSdk\Api\Entities\VmQueryResult;
use Superciety\ElrondSdk\Api\Entities\VmStringResult;

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

    public function string(string $contractAddress, string $func, array $args = [], array $params = []): VmStringResult
    {
        return VmStringResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/vm-values/string", [
                'scAddress' => $contractAddress,
                'funcName' => $func,
                'args' => collect($args)->map(fn ($a) => Encoder::toHex($a))->all(),
                ...$params,
            ], unwrapData: true)
        );
    }

    public function int(string $contractAddress, string $func, array $args = [], array $params = []): VmIntResult
    {
        return VmIntResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/vm-values/int", [
                'scAddress' => $contractAddress,
                'funcName' => $func,
                'args' => collect($args)->map(fn ($a) => Encoder::toHex($a))->all(),
                ...$params,
            ], unwrapData: true)
        );
    }
}
