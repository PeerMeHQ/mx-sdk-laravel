<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Superciety\ElrondSdk\Api\ApiTransformable;

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
