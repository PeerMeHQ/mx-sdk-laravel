<?php

namespace Superciety\ElrondSdk\Http\Converters;

use Superciety\ElrondSdk\Api\Entities\VmHexResult;
use Superciety\ElrondSdk\Api\Entities\VmIntResult;
use Superciety\ElrondSdk\Api\Entities\VmQueryResult;
use Superciety\ElrondSdk\Api\Entities\VmStringResult;

class VmResultResponseConverter
{
    public static function single(VmQueryResult|VmHexResult|VmStringResult|VmIntResult $query): array
    {
        return [
            'data' => $query->data,
        ];
    }
}
