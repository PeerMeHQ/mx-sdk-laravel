<?php

namespace Superciety\ElrondSdk\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Superciety\ElrondSdk\Http\ControllerBase;
use Superciety\ElrondSdk\PreparedQueries\IVmQuery;

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
        $user = request()->user();

        if (!$builder instanceof IVmQuery) {
            return $this->invalid(['error' => "no query builder found for '{$name}'"]);
        }

        $builder->execute($request->all(), $user);

        return $this->ok($builder->toResponse());
    }
}
