<?php

namespace MultiversX\Exceptions;

use Exception;

class NativeAuthInvalidSignatureException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid signature');
    }
}
