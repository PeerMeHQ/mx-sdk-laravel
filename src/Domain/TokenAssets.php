<?php

namespace Superciety\ElrondSdk\Domain;

use Superciety\ElrondSdk\Api\ApiTransformable;

final class TokenAssets
{
    use ApiTransformable;

    public function __construct(
        public ?string $website = null,
        public string $description,
        public string $status,
        public string $pngUrl,
        public string $svgUrl,
    ) {
    }
}
