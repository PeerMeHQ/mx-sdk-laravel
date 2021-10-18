<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\Elrond;
use Spatie\Snapshots\MatchesSnapshots;
use Superciety\ElrondSdk\Tests\TestCase;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

class BlocksTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_gets_a_hyperblock_by_nonce()
    {
        $this->fakeApiRequestWithResponse('/hyperblock/by-nonce/12345', 'blocks/hyperblock_by_nonce.json');

        $actual = Elrond::api()
            ->blocks()
            ->getHyperblockByNonce('12345');

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }

    /** @test */
    public function it_gets_a_hyperblock_by_hash()
    {
        $this->fakeApiRequestWithResponse('/hyperblock/by-hash/d6f029c04b84cc1fcda318cb309c89974369f0af735a6de9d9ef35d15c5169c1', 'blocks/hyperblock_by_hash.json');

        $actual = Elrond::api()
            ->blocks()
            ->getHyperblockByHash('d6f029c04b84cc1fcda318cb309c89974369f0af735a6de9d9ef35d15c5169c1');

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }
}
