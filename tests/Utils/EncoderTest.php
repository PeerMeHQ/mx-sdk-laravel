<?php

use Superciety\ElrondSdk\Utils\Encoder;

it('toHex - encodes strings into hex', fn () => expect(Encoder::toHex('anything'))->toBe('616e797468696e67'));

it('toHex - encodes single-byte into into hex', fn () => expect(Encoder::toHex(2))->toBe('02'));

it('toHex - encodes multi-byte into into hex', fn () => expect(Encoder::toHex(257))->toBe('0101'));

it('toHex - encodes an address string into into hex', fn () => expect(Encoder::toHex('erd18fswpz2r2q3p40jlewkt9u7d46lvrukdn8j09tppza75efv0jz8s2lc68r'))->toBe('3a60e0894350221abe5fcbacb2f3cdaebec1f2cd99e4f2ac21177d4ca58f908f'));
