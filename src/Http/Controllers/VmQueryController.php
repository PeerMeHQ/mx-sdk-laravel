<?php

namespace Superciety\ElrondSdk\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Superciety\ElrondSdk\Http\ControllerBase;
use Superciety\ElrondSdk\PreparedQueries\IVmQueryBuilder;
use Superciety\ElrondSdk\Http\Converters\VmResultResponseConverter;

class VmQueryController extends ControllerBase
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(string $name, Request $request)
    {
        $builderClass = collect(config("elrond.vm_queries"))
            ->get($name) ?? throw new InvalidArgumentException("no vm query configured for '{$name}'");

        $builder = new $builderClass();

        return $builder instanceof IVmQueryBuilder
            ? $this->ok(VmResultResponseConverter::single($builder->build($request->all())))
            : $this->invalid([
                'error' => "no query builder found for '{$name}'",
            ]);
    }
}
