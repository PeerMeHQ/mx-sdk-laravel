<?php

namespace Superciety\ElrondSdk\Api;

use Illuminate\Support\Collection;

abstract class ResponseBase
{
    public static function fromResponse(array $res): static
    {
        return new static(...static::filterUnallowedProperties(
            static::transformResponse($res)
        ));
    }

    public static function fromResponseMany(array $res): Collection
    {
        return (new Collection($res))
            ->map(fn ($nested) => static::fromResponse($nested))
            ->values();
    }

    protected static function transformResponse(array $res): array
    {
        return $res;
    }

    protected static function filterUnallowedProperties(array $res): array
    {
        return (new Collection($res))
            ->intersectByKeys(get_class_vars(static::class))
            ->all();
    }
}
