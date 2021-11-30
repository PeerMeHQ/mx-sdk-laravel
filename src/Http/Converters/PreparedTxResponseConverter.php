<?php

namespace Superciety\ElrondSdk\Http\Converters;

use Superciety\ElrondSdk\Domain\PreparedTx;

class PreparedTxResponseConverter
{
    public static function single(PreparedTx $tx): array
    {
        return [
            'sender' => request()->user()?->address,
            'receiver' => $tx->receiver,
            'value' => $tx->value->amount,
            'data' => $tx->data->toBase64(),
            'gasLimit' => $tx->gasLimit,
            'chainID' => $tx->getChainId(),
        ];
    }
}
