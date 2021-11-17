<?php

use Superciety\ElrondSdk\Domain\Balance;

it('has the desired precision given an already precise value', fn () => expect(Balance::egld("12000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an already precise decimal value', fn () => expect(Balance::egld("12.000000000000000000")->amount)->toBe("12000000000000000000"));

it('has the desired precision given an integer', fn () => expect(Balance::egld(12)->amount)->toBe("12000000000000000000"));

it('has the desired precision given a non-precise float', fn () => expect(Balance::egld(12.12345)->amount)->toBe("12123450000000000000"));

it('has the desired precision given a non-precise string', fn () => expect(Balance::egld("12.12345")->amount)->toBe("12123450000000000000"));
