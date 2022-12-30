<?php

use Peerme\Multiversx\Domain\TokenPayment;

it('has the desired precision given an integer', fn () => expect((string) TokenPayment::egldFromAmount(12)->amountAsBigInteger)->toBe('12000000000000000000'));

it('has the desired precision given a non-precise float', fn () => expect((string) TokenPayment::egldFromAmount(12.12345)->amountAsBigInteger)->toBe('12123450000000000000'));

it('toDenominated - denominates', fn () => expect(TokenPayment::egldFromBigInteger('10000000000000000000000000')->toDenominated())->toBe('10000000'));

it('toDenominated - denominates with formatting', fn () => expect(TokenPayment::egldFromBigInteger('10000000000000000000000000')->toDenominated(formatted: true))->toBe('10,000,000'));

it('toDenominated - handles zero value', fn () => expect(TokenPayment::egldFromBigInteger('0')->toDenominated())->toBe('0'));

it('toDenominated - does not have trailing zeros', fn () => expect(TokenPayment::egldFromAmount(12.12345)->toDenominated())->toBe('12.12345'));

it('toDenominated - correctly displays inpresice string values', fn () => expect(TokenPayment::egldFromBigInteger('826671350000000')->toDenominated())->toBe('0.00082667135'));

it('toDenominated - does not show decimals for tokens without decimals', fn () => expect(TokenPayment::fungibleFromAmount('-', 10, 0)->toDenominated())->toBe('10'));

it('toDenominated - correctly displays values floating numbers', fn () => expect(TokenPayment::fungibleFromAmount('-', 0.00086, 18)->toDenominated())->toBe('0.00086'));

it('toDenominated - strips trailing zeros', fn () => expect(TokenPayment::fungibleFromAmount('-', 0.10000086, 18)->toDenominated())->toBe('0.10000086'));

it('toInt - casts to an int primitive', fn () => expect(TokenPayment::egldFromBigInteger('5000000000000000001234')->toInt())->toBe(5000));
