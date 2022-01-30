<?php

namespace Superciety\ElrondSdk\Domain\Interfaces;

use Superciety\ElrondSdk\Domain\Signature;

interface IVerifiable
{
    public function serializeForSigning(): string;

    public function getSignature(): Signature;
}
