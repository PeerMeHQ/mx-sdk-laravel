<?php

use Superciety\ElrondSdk\Elrond;

it('decodes bech32 to hex', fn ($bech32, $expectedHex) => expect(Elrond::crypto()->decodeBech32ToHex($bech32))->toBe($expectedHex))
    ->with([
        ['erd18fswpz2r2q3p40jlewkt9u7d46lvrukdn8j09tppza75efv0jz8s2lc68r', '3a60e0894350221abe5fcbacb2f3cdaebec1f2cd99e4f2ac21177d4ca58f908f'],
        ['erd1367z5dtnjt00t3sshczrvuw56nmhegvt6nu25zffh7wxv0ypqykshauu5q', '8ebc2a357392def5c610be043671d4d4f77ca18bd4f8aa0929bf9c663c81012d'],
        ['erd1qykmyrqemuh3998jwd9t73eu0ce8nudzf7tzdeelrrru69dqwt2scrsz7k', '012db20c19df2f1294f2734abf473c7e3279f1a24f9626e73f18c7cd15a072d5'],
        ['erd1ycvtp4x0y9xep0hfedevm4ql4y7vwxuwqm5taj76n368w6s02ldsfpd3au', '2618b0d4cf214d90bee9cb72cdd41fa93cc71b8e06e8becbda9c74776a0f57db'],
    ]);
