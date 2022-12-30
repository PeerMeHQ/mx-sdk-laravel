<?php

namespace Peerme\Multiversx\Domain\Interfaces;

use Peerme\Multiversx\Domain\Signature;

interface ISignable
{
    public function serializeForSigning(): string;

    public function applySignature(Signature $signature): void;
}
