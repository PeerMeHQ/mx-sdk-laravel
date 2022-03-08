<?php

namespace Superciety\ElrondSdk\PreparedQueries;

interface IVmQuery
{
    public function execute(array $input, $user): self;

    public function toResponse(): array;
}
