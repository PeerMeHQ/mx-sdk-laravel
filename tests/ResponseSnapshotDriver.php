<?php

namespace Superciety\ElrondSdk\Tests;

use Spatie\Snapshots\Driver;
use PHPUnit\Framework\Assert;
use Superciety\ElrondSdk\ResponseBase;
use Spatie\Snapshots\Exceptions\CantBeSerialized;

class ResponseSnapshotDriver implements Driver
{
    public function serialize($data): string
    {
        if (! $data instanceof ResponseBase) {
            throw new CantBeSerialized('Data must extend ResponseBase');
        }

        return serialize($data);
    }

    public function extension(): string
    {
        return 'txt';
    }

    public function match($expected, $actual)
    {
        Assert::assertEquals(serialize($actual), $expected);
    }
}
