<?php

namespace Superciety\ElrondSdk\Api;

use Illuminate\Support\Collection;

trait ApiTransformable
{
    public array $rawResponse = [];

    public static function fromApiResponse(array $res): static
    {
        $entity = new static(...static::filterUnallowedProperties(
            static::transformResponse($res)
        ));

        $entity->rawResponse = $res;

        return $entity;
    }

    public static function fromApiResponseMany(array $res): Collection
    {
        return (new Collection($res))
            ->map(fn ($nested) => static::fromApiResponse($nested))
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
