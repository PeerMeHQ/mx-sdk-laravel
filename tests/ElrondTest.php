<?php

namespace Superciety\ElrondSdk;

use Superciety\ElrondSdk\Domain\TokenPayment;
use Illuminate\Validation\ValidationException;

it('requireAccountTokenOwnershipOrThrow - it passes if account holds a minimum amount of specified token', function () {
    $tokenId = 'WHALE-b018f0';
    $minValue = TokenPayment::fungibleFromAmount($tokenId, 50, 6);

    fakeApiRequestWithResponse("*", 'accounts/token-with-balance.json');

    Elrond::requireAccountTokenOwnershipOrThrow('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', $minValue);

    expect(true)->toBeTrue();
});

it('requireAccountTokenOwnershipOrThrow - it throws if account does not hold enough tokens', function () {
    $address = 'erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc';
    $tokenId = 'WHALE-b018f0';
    $minValue = TokenPayment::fungibleFromAmount($tokenId, 1_500_000, 6);

    fakeApiRequestWithResponse("/accounts/{$address}/tokens/{$tokenId}", 'accounts/token-with-balance.json');

    Elrond::requireAccountTokenOwnershipOrThrow('erd1660va6y429mxz4dkgek0ssny8tccaaaaaaaaaabbbbbbbbbbcccccccccc', $minValue);
})->throws(ValidationException::class);
