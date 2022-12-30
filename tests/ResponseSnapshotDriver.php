<?php

namespace Peerme\Multiversx\Tests;

use Spatie\Snapshots\Driver;
use PHPUnit\Framework\Assert;

class ResponseSnapshotDriver implements Driver
{
    public function serialize($data): string
    {
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
