<?php

use Superciety\ElrondSdk\Domain\Balance;

it('has the desired precision given an already precise value', fn () => expect(Balance::egld("12000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an already precise decimal value', fn () => expect(Balance::egld("12.000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an integer', fn () => expect(Balance::egld(12)->amount)->toBe("12000000000000000000"));

it('has the desired precision given a non-precise float', fn () => expect(Balance::egld(12.12345)->amount)->toBe("12123450000000000000"));

it('has the desired precision given a non-precise string', fn () => expect(Balance::egld("12.12345")->amount)->toBe("12123450000000000000"));

it('toDenominated - does not have trailing zeros', fn () => expect(Balance::egld("12.12345")->toDenominated())->toBe("12.12345"));

it('toDenominated - allows an optional decimal precision', fn () => expect(Balance::egld("12.12345")->toDenominated(3))->toBe("12.123"));

it('plus - adds a balance of the same token to the current balance', function () {
    $balance = Balance::egld('10000000000000000000');

    $balance->plus(Balance::egld('15000000000000000000'));

    expect($balance->amount)->toBe('25000000000000000000');
});

it('minus - substracts a balance of the same token to the current balance', function () {
    $balance = Balance::egld('15000000000000000000');

    $balance->minus(Balance::egld('10000000000000000000'));

    expect($balance->amount)->toBe('5000000000000000000');
});
