<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Superciety\ElrondSdk\Utils\Encoder;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Domain\VmQueryResult;

class VmEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function query(string $contractAddress, string $func, array $args = []): VmQueryResult
    {
        return VmQueryResult::fromApiResponse(
            $this->request('POST', "{$this->getApiBaseUrl()}/vm-values/query", [
                'scAddress' => $contractAddress,
                'funcName' => $func,
                'args' => collect($args)->map(fn ($a) => Encoder::toHex($a))->all(),
            ], unwrapData: true)
        );
    }
}
