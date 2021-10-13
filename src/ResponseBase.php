<?php

namespace Superciety\ElrondSdk;

use Illuminate\Support\Collection;

abstract class ResponseBase
{
    public static function fromResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties($res));
    }

    public static function fromResponseMany(array $res): Collection
    {
        return (new Collection($res))
            ->map(fn ($nested) => new static(...static::filterUnallowedProperties($nested)))
            ->values();
    }

    protected static function filterUnallowedProperties(array $res): array
    {
        return (new Collection($res))
            ->intersectByKeys(get_class_vars(static::class))
            ->all();
    }
}
