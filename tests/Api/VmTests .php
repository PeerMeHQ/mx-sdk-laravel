<?php

use Superciety\ElrondSdk\Elrond;

it('queries a multiresult smart contract view successfully', function () {
    fakeApiRequestWithResponse('/vm-values/query*', 'vm/ok-multiresult2.json');

    $actual = Elrond::api()
        ->vm()
        ->query('erd1qqqqqqqqqqqqqpgq6n6efmj9slp33s67jjralruh64ku0dd0yt2sumuhtq', 'getImageNftIdByAddress', [
            'erd1lrkkzpcmnzfe2ydrw6l8el3d3mkz5lwyct65nhjn4ss0vx2aqhuq0qxcd6'
        ]);

    assertMatchesResponseSnapshot($actual);
});
