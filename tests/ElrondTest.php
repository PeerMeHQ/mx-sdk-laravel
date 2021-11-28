<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Domain\Token;
use Superciety\ElrondSdk\Domain\Balance;
use Illuminate\Validation\ValidationException;

it('requireAccountTokenOwnershipOrThrow - it passes if account holds a minimum amount of specified token', function () {
    $address = 'erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc';
    $tokenId = 'WHALE-b018f0';
    $token = new Token($tokenId, 'Whale', 6);
    $minBalance = Balance::from($token, 50);

    fakeApiRequestWithResponse("/accounts/{$address}/tokens/{$tokenId}", 'accounts/token-with-balance.json');

    Elrond::requireAccountTokenOwnershipOrThrow('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', $minBalance);

    expect(true)->toBeTrue();
});

it('requireAccountTokenOwnershipOrThrow - it throws if account does not hold enough tokens', function () {
    $address = 'erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc';
    $tokenId = 'WHALE-b018f0';
    $token = new Token($tokenId, 'Whale', 6);
    $minBalance = Balance::from($token, 1_500_000);

    fakeApiRequestWithResponse("/accounts/{$address}/tokens/{$tokenId}", 'accounts/token-with-balance.json');

    Elrond::requireAccountTokenOwnershipOrThrow('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', $minBalance);
})->throws(ValidationException::class);
