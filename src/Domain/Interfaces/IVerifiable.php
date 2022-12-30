<?php

namespace Peerme\Multiversx\Domain\Interfaces;

use Peerme\Multiversx\Domain\Signature;

interface IVerifiable
{
    public function serializeForSigning(): string;

    public function getSignature(): Signature;
}
