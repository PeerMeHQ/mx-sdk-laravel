<?php

namespace Superciety\ElrondSdk\Domain\Interfaces;

use Superciety\ElrondSdk\Domain\Signature;

interface ISignable
{
    public function serializeForSigning(): string;

    public function applySignature(Signature $signature): void;
}
