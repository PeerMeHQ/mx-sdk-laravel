<?php

namespace Peerme\Multiversx\Domain;

class Signature
{
    public function __construct(
        private string $valueHex,
    ) {
    }

    public function hex(): string
    {
        return $this->valueHex;
    }
}
