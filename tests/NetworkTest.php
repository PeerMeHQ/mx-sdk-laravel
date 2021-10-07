<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\ElrondApi;
use Spatie\Snapshots\MatchesSnapshots;
use Superciety\ElrondSdk\Tests\TestCase;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

class NetworkTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_fetches_economics()
    {
        $this->fakeHttpWithResponse('/economics', 'economics.json');

        $actual = ElrondApi::network()->getEconomics();

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }
}
