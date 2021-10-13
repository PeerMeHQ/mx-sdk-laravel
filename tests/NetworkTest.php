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
    public function it_gets_economics()
    {
        $this->fakeHttpWithResponse('/network/economics', 'network/economics.json');

        $actual = ElrondApi::network()->getEconomics();

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }

    /** @test */
    public function it_gets_network_configs()
    {
        $this->fakeHttpWithResponse('/network/config', 'network/config.json');

        $actual = ElrondApi::network()->getNetworkConfig();

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }

    /** @test */
    public function it_gets_shard_status()
    {
        $this->fakeHttpWithResponse('/network/status/1', 'network/shard-status.json');

        $actual = ElrondApi::network()->getShardStatus(1);

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }
}
