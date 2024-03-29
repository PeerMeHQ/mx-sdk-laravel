<?php

namespace MultiversX\Exceptions;

use Exception;

class NativeAuthOriginNotAcceptedException extends Exception
{
    public function __construct(string $origin)
    {
        parent::__construct("Origin ({$origin}) not accepted");
    }
}
