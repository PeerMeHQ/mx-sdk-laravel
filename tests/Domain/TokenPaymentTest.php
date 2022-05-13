<?php

use Superciety\ElrondSdk\Domain\TokenPayment;

it('has the desired precision given an integer', fn () => expect(TokenPayment::egldFromAmount(12)->amountAsBigInteger)->toBe('12000000000000000000'));

it('has the desired precision given a non-precise float', fn () => expect(TokenPayment::egldFromAmount(12.12345)->amountAsBigInteger)->toBe('12123450000000000000'));

it('toDenominated - denominates', fn () => expect(TokenPayment::egldFromBigInteger('10000000000000000000000000')->toDenominated())->toBe('10000000'));

it('toDenominated - denominates with formatting', fn () => expect(TokenPayment::egldFromBigInteger('10000000000000000000000000')->toDenominated(formatted: true))->toBe('10,000,000'));

it('toDenominated - handles zero value', fn () => expect(TokenPayment::egldFromBigInteger('0')->toDenominated())->toBe('0'));

it('toDenominated - does not have trailing zeros', fn () => expect(TokenPayment::egldFromAmount(12.12345)->toDenominated())->toBe('12.12345'));

it('toDenominated - correctly displays inpresice string values', fn () => expect(TokenPayment::egldFromBigInteger('826671350000000')->toDenominated())->toBe('0.82667135'));

it('toDenominated - does not show decimals for tokens without decimals', fn () => expect(TokenPayment::fungibleFromAmount('-', 10, 0)->toDenominated())->toBe('10'));

it('toDenominated - correctly displays values floating numbers', fn () => expect(TokenPayment::fungibleFromAmount('-', 0.00086, 18)->toDenominated())->toBe('0.00086'));

it('toDenominated - strips trailing zeros', fn () => expect(TokenPayment::fungibleFromAmount('-', 0.10000086, 18)->toDenominated())->toBe('0.10000086'));

it('plus - adds a balance of the same token to the current balance', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->plus(TokenPayment::egldFromBigInteger('15000000000000000000'))->amountAsBigInteger)->toBe('25000000000000000000');
});

it('minus - substracts a balance of the same token to the current balance', function () {
    expect(TokenPayment::egldFromBigInteger('15000000000000000000')->minus(TokenPayment::egldFromBigInteger('10000000000000000000'))->amountAsBigInteger)->toBe('5000000000000000000');
});

it('isGreaterThan - returns true if balance is higher than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('15000000000000000000')->isGreaterThan(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeTrue();
});

it('isGreaterThan - returns false if balance is lower than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isGreaterThan(TokenPayment::egldFromBigInteger('15000000000000000000')))->toBeFalse();
});

it('isLessThan - returns true if balance is lower than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isLessThan(TokenPayment::egldFromBigInteger('15000000000000000000')))->toBeTrue();
});

it('isLessThan - returns false if balance is higher than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('15000000000000000000')->isLessThan(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeFalse();
});

it('isGreaterThanOrEqualTo - returns true if balance is equal or higher than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isGreaterThanOrEqualTo(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeTrue();
    expect(TokenPayment::egldFromBigInteger('15000000000000000000')->isGreaterThanOrEqualTo(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeTrue();
});

it('isGreaterThanOrEqualTo - returns false if balance is less than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isGreaterThanOrEqualTo(TokenPayment::egldFromBigInteger('15000000000000000000')))->toBeFalse();
});

it('isLessThanOrEqualTo - returns true if balance is equal or less than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isLessThanOrEqualTo(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeTrue();
    expect(TokenPayment::egldFromBigInteger('10000000000000000000')->isLessThanOrEqualTo(TokenPayment::egldFromBigInteger('15000000000000000000')))->toBeTrue();
});

it('isLessThanOrEqualTo - returns false if balance is higher than the one given', function () {
    expect(TokenPayment::egldFromBigInteger('15000000000000000000')->isLessThanOrEqualTo(TokenPayment::egldFromBigInteger('10000000000000000000')))->toBeFalse();
});
