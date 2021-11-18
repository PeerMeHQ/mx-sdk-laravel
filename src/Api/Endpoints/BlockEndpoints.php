<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\Block;
use Superciety\ElrondSdk\Api\Entities\Hyperblock;

final class BlockEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getBlocks(array $params = []): Collection
    {
        return Block::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/blocks", $params)
        );
    }

    public function getHyperblockByNonce(string $nonce): Hyperblock
    {
        return Hyperblock::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/hyperblock/by-nonce/{$nonce}", unwrapData: true)['hyperblock']
        );
    }

    public function getHyperblockByHash(string $nonce): Hyperblock
    {
        return Hyperblock::fromApiResponse(
            $this->request('GET', "{$this->getApiBaseUrl()}/hyperblock/by-hash/{$nonce}", unwrapData: true)['hyperblock']
        );
    }
}
