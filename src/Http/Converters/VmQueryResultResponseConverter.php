<?php

namespace Superciety\ElrondSdk\Http\Converters;

use Superciety\ElrondSdk\Domain\VmQueryResult;

class VmQueryResultResponseConverter
{
    public static function single(VmQueryResult $query): array
    {
        return [
            'code' => $query->code,
            'data' => $query->data,
        ];
    }
}
