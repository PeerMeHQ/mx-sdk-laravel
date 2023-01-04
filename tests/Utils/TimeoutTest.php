<?php

use function Spatie\PestPluginTestTime\testTime;
use Peerme\MxLaravel\Utils\Timeout;

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
