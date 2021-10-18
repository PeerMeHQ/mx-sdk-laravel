<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\Elrond;
use Spatie\Snapshots\MatchesSnapshots;
use Superciety\ElrondSdk\Tests\TestCase;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

class NetworkTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_gets_economics()
    {
        $this->fakeApiRequestWithResponse('/network/economics', 'network/economics.json');

        $actual = Elrond::api()
            ->network()
            ->getEconomics();

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }

    /** @test */
    public function it_gets_network_configs()
    {
        $this->fakeApiRequestWithResponse('/network/config', 'network/config.json');

        $actual = Elrond::api()
            ->network()
            ->getNetworkConfig();

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }

    /** @test */
    public function it_gets_shard_status()
    {
        $this->fakeApiRequestWithResponse('/network/status/1', 'network/shard-status.json');

        $actual = Elrond::api()
            ->network()
            ->getShardStatus(1);

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }
}
