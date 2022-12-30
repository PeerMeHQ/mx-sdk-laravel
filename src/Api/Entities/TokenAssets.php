<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

final class TokenAssets
{
    use ApiTransformable;

    public function __construct(
        public string $description,
        public string $status,
        public string $pngUrl,
        public string $svgUrl,
        public ?string $website = null,
    ) {
    }
}
