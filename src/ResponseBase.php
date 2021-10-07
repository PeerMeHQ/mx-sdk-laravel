<?php

namespace Superciety\ElrondSdk;

abstract class ResponseBase
{
    public static function fromResponse(array $res): static
    {
        return new static(...$res);
    }
}
