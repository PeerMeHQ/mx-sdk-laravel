<?php

use Peerme\Multiversx\Utils\Decoder;

it('fromBase64Int - decodes base64 encoded integers', fn ($base64, $dec) => expect(Decoder::fromBase64Int($base64))->toBe($dec))
    ->with([
        ['Ag===', 2],
        ['Jjg=', 9784],
    ]);

it('fromBase64BigUint - decodes base64 encoded integers', fn ($base64, $val) => expect((string) Decoder::fromBase64BigUint($base64))->toBe($val))
    ->with([
        ['LBKkOIqYlAAA', '813000000000000000000'],
    ]);

it('bchexdec - decodes a hex encoded bignumber', fn ($hex, $val) => expect(Decoder::bchexdec($hex))->toBe($val))
    ->with([
        ['015af1d78b58c40000', '25000000000000000000'],
        ['1569b9e733474c0000', '395000000000000000000'],
    ]);
