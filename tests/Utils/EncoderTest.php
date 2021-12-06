<?php

use Superciety\ElrondSdk\Utils\Encoder;

it('toHex it converts strings to hex', fn () => expect(Encoder::toHex('anything'))->toBe('616e797468696e67'));

it('toHex it converts single-byte ints to hex', fn () => expect(Encoder::toHex(2))->toBe('02'));

it('toHex it converts multi-byte ints to hex', fn () => expect(Encoder::toHex(257))->toBe('0101'));
