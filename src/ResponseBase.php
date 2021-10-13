<?php

namespace Superciety\ElrondSdk;

use Illuminate\Support\Collection;

abstract class ResponseBase
{
    public static function fromResponse(array $res): static
    {
        return new static(...$res);
    }

    public static function fromResponseMany(array $res): array
    {
        return (new Collection($res))
            ->map(fn ($nested) => new static(...$nested))
            ->all();
    }
}
