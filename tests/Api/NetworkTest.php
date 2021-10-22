<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\Elrond;
use Spatie\Snapshots\MatchesSnapshots;
use Superciety\ElrondSdk\Tests\TestCase;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

it('gets economics', function () {
    fakeApiRequestWithResponse('/network/economics', 'network/economics.json');

    $actual = Elrond::api()
        ->network()
        ->getEconomics();

    assertMatchesResponseSnapshot($actual);
});

it('gets network configs', function () {
    fakeApiRequestWithResponse('/network/config', 'network/config.json');

    $actual = Elrond::api()
        ->network()
        ->getNetworkConfig();

    assertMatchesResponseSnapshot($actual);
});

it('gets shard status', function () {
    fakeApiRequestWithResponse('/network/status/1', 'network/shard-status.json');

    $actual = Elrond::api()
        ->network()
        ->getShardStatus(1);

    assertMatchesResponseSnapshot($actual);
});
