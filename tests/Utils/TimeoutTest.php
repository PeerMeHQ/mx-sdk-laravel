<?php

use Superciety\ElrondSdk\Utils\Timeout;
use function Spatie\PestPluginTestTime\testTime;

it('executes the action on first run', function () {
    expect(Timeout::for('testaction', now()->addHour(), fn () => 0))
        ->toBeTrue();
});

it('executes a second time only after timeout passed', function () {
    testTime()->freeze();

    expect(Timeout::for('testaction', now()->addHour(), fn () => 0))
        ->toBeTrue();

    expect(Timeout::for('testaction', now()->addHour(), fn () => 0))
        ->toBeFalse();

    testTime()->addHour()->addMinute();

    expect(Timeout::for('testaction', now()->addHour(), fn () => 0))
        ->toBeTrue();
});
