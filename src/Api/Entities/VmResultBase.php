<?php

namespace Peerme\Multiversx\Api\Entities;

use Peerme\Multiversx\Api\ApiTransformable;

class VmResultBase
{
    use ApiTransformable;

    public function __construct(
        public $data,
    ) {
    }
}
