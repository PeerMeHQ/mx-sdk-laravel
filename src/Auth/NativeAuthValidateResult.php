<?php

namespace MultiversX\Auth;

class NativeAuthValidateResult
{
    public function __construct(
        public int $issued = 0,
        public int $expires = 0,
        public string $address = '',
        public string $origin = '',
        public mixed $extraInfo = null,
    ) {
    }
}
