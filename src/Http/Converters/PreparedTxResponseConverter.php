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
            'value' => (string) $tx->value->amountAsBigInteger,
            'data' => $tx->data->toBase64(),
            'gasLimit' => $tx->gasLimit,
            'chainID' => $tx->getChainId(),
        ];
    }
}
