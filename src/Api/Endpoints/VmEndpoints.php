<?php

namespace Peerme\Multiversx\Api\Endpoints;

use Carbon\Carbon;
use Peerme\Multiversx\Utils\Encoder;
use Peerme\Multiversx\Api\EndpointBase;
use Peerme\Multiversx\Api\Entities\VmHexResult;
use Peerme\Multiversx\Api\Entities\VmIntResult;
use Peerme\Multiversx\Api\Entities\VmQueryResult;
use Peerme\Multiversx\Api\Entities\VmStringResult;

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
