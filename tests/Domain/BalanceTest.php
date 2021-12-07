<?php

use Superciety\ElrondSdk\Domain\Token;
use Superciety\ElrondSdk\Domain\Balance;

it('has the desired precision given an already precise value', fn () => expect(Balance::egld("12000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an already precise decimal value', fn () => expect(Balance::egld("12.000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an integer', fn () => expect(Balance::egld(12)->amount)->toBe("12000000000000000000"));

it('has the desired precision given an integer bigger in length than token decimals', fn () => expect(Balance::from(new Token('any', 'any', 3), 10_000_000)->amount)->toBe("10000000000"));

it('has the desired precision given a non-precise float', fn () => expect(Balance::egld(12.12345)->amount)->toBe("12123450000000000000"));

it('has the desired precision given a non-precise string', fn () => expect(Balance::egld("12.12345")->amount)->toBe("12123450000000000000"));

it('toDenominated - does not have trailing zeros', fn () => expect(Balance::egld("12.12345")->toDenominated())->toBe("12.12345"));

it('toDenominated - allows an optional decimal precision', fn () => expect(Balance::egld("12.12345")->toDenominated(3))->toBe("12.123"));

it('toDenominated - does not show decimals for tokens without decimals', fn () => expect(Balance::from(new Token('any', 'any', 0), 10)->toDenominated())->toBe("10"));

it('plus - adds a balance of the same token to the current balance', function () {
    expect(Balance::egld('10000000000000000000')->plus(Balance::egld('15000000000000000000'))->amount)->toBe('25000000000000000000');
});

it('minus - substracts a balance of the same token to the current balance', function () {
    expect(Balance::egld('15000000000000000000')->minus(Balance::egld('10000000000000000000'))->amount)->toBe('5000000000000000000');
});

it('isMoreThan - returns true if balance is higher than the one given', function () {
    expect(Balance::egld('15000000000000000000')->isMoreThan(Balance::egld('10000000000000000000')))->toBeTrue();
});

it('isMoreThan - returns false if balance is lower than the one given', function () {
    expect(Balance::egld('10000000000000000000')->isMoreThan(Balance::egld('15000000000000000000')))->toBeFalse();
});

it('isLessThan - returns true if balance is lower than the one given', function () {
    expect(Balance::egld('10000000000000000000')->isLessThan(Balance::egld('15000000000000000000')))->toBeTrue();
});

it('isLessThan - returns false if balance is higher than the one given', function () {
    expect(Balance::egld('15000000000000000000')->isLessThan(Balance::egld('10000000000000000000')))->toBeFalse();
});

it('isEqualOrMoreThan - returns true if balance is equal or higher than the one given', function () {
    expect(Balance::egld('10000000000000000000')->isEqualOrMoreThan(Balance::egld('10000000000000000000')))->toBeTrue();
    expect(Balance::egld('15000000000000000000')->isEqualOrMoreThan(Balance::egld('10000000000000000000')))->toBeTrue();
});

it('isEqualOrMoreThan - returns false if balance is less than the one given', function () {
    expect(Balance::egld('10000000000000000000')->isEqualOrMoreThan(Balance::egld('15000000000000000000')))->toBeFalse();
});

it('isEqualOrLessThan - returns true if balance is equal or less than the one given', function () {
    expect(Balance::egld('10000000000000000000')->isEqualOrLessThan(Balance::egld('10000000000000000000')))->toBeTrue();
    expect(Balance::egld('10000000000000000000')->isEqualOrLessThan(Balance::egld('15000000000000000000')))->toBeTrue();
});

it('isEqualOrLessThan - returns false if balance is higher than the one given', function () {
    expect(Balance::egld('15000000000000000000')->isEqualOrLessThan(Balance::egld('10000000000000000000')))->toBeFalse();
});
