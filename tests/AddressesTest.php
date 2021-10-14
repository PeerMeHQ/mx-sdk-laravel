<?php

namespace Superciety\ElrondSdk\Tests;

use Superciety\ElrondSdk\ElrondApi;
use Spatie\Snapshots\MatchesSnapshots;
use Superciety\ElrondSdk\Tests\TestCase;
use Superciety\ElrondSdk\Tests\ResponseSnapshotDriver;

class AddressesTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_gets_an_address()
    {
        $this->fakeHttpWithResponse('/addresses/erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', 'addresses/address.json');

        $actual = ElrondApi::addresses()->getAddress('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc');

        $this->assertMatchesSnapshot($actual, new ResponseSnapshotDriver);
    }
}
