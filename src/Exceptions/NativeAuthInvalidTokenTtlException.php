<?php

namespace MultiversX\Exceptions;

use Exception;

class NativeAuthInvalidTokenTtlException extends Exception
{
    public function __construct(int $currentTtl, int $maxTtl)
    {
        parent::__construct(
            "The provided TTL in the token ({$currentTtl}) is larger than the maximum allowed TTL ({$maxTtl})"
        );
    }
}
