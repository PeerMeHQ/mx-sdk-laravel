<?php

namespace Superciety\ElrondSdk\Api\Blocks;

use Carbon\Carbon;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Blocks\Responses\Hyperblock;

final class BlockEndpoints extends EndpointBase
{
    public function __construct(
        private ?Carbon $cacheTtl,
    ) {
    }

    public function getHyperblockByNonce(string $nonce): Hyperblock
    {
        return Hyperblock::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/hyperblock/by-nonce/{$nonce}", $this->cacheTtl)['hyperblock']
        );
    }

    public function getHyperblockByHash(string $nonce): Hyperblock
    {
        return Hyperblock::fromApiResponse(
            static::request('GET', "{$this->getApiBaseUrl()}/hyperblock/by-hash/{$nonce}", $this->cacheTtl)['hyperblock']
        );
    }
}
