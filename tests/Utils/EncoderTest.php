<?php

use Brick\Math\BigInteger;
use Peerme\Multiversx\Domain\Address;
use Peerme\Multiversx\Utils\Encoder;

it('toHex - encodes strings into hex', fn () => expect(Encoder::toHex('anything'))->toBe('616e797468696e67'));

it('toHex - encodes single-byte into hex', fn () => expect(Encoder::toHex(2))->toBe('02'));

it('toHex - encodes multi-byte into hex', fn () => expect(Encoder::toHex(257))->toBe('0101'));

it('toHex - encodes an address into hex', fn () => expect(Encoder::toHex(Address::fromBech32('erd18fswpz2r2q3p40jlewkt9u7d46lvrukdn8j09tppza75efv0jz8s2lc68r')))->toBe('3a60e0894350221abe5fcbacb2f3cdaebec1f2cd99e4f2ac21177d4ca58f908f'));

it('toHex - encodes an address string into hex', fn () => expect(Encoder::toHex('erd18fswpz2r2q3p40jlewkt9u7d46lvrukdn8j09tppza75efv0jz8s2lc68r'))->toBe('3a60e0894350221abe5fcbacb2f3cdaebec1f2cd99e4f2ac21177d4ca58f908f'));

it('toHex - encodes an bigint into hex', fn ($hex, $val) => expect(Encoder::toHex(BigInteger::of($val)))->toBe($hex))
    ->with([
        ['015af1d78b58c40000', '25000000000000000000'],
        ['d3c21bcecceda1000000', '1000000000000000000000000'],
    ]);
