<?php

namespace MultiversX\Exceptions;

use Exception;

class NativeAuthTokenExpiredException extends Exception
{
    public function __construct()
    {
        parent::__construct('Token expired');
    }
}
