<?php

namespace Superciety\ElrondSdk\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Superciety\ElrondSdk\Http\ControllerBase;
use Superciety\ElrondSdk\PreparedTxs\IPreparedTxBuilder;

class PreparedTxController extends ControllerBase
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(string $name, Request $request)
    {
        $builderClass = collect(config("elrond.prepared_txs"))
            ->get($name) ?? throw new InvalidArgumentException("no prepared tx configured for '{$name}'");

        $builder = new $builderClass();

        return $builder instanceof IPreparedTxBuilder
            ? $this->preparedTx($builder->build($request->all()))
            : $this->invalid([
                'error' => "no tx builder found for '{$name}'",
            ]);
    }
}
