<?php

use Peerme\Multiversx\Utils\Formatter;

it('trims a hash', function () {
    $actual = Formatter::trimHash('4a770452b02f8511ebda39f9de29b8b7c3478cf87c64287d3bca7fd96a0595b9', 4);

    expect($actual)->toBe('4a77...95b9');
});
