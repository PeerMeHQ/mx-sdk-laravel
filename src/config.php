<?php

return [

    'chain_id' => env('ELROND_CHAIN_ID', '1'),

    'urls' => [

        /**
         * the base url of on elrond api — not proxy from a gateway.
         * feel free to host your own api for absolute control, or
         * fall back to the one provided by elrond.
         * e.g:
         * - mainnet: https://api.elrond.com
         * - testnet: https://testnet-api.elrond.com
         * - devnet: https://devnet-api.elrond.com
         */
        'api' => env('ELROND_URL_API', 'https://api.elrond.com'),
    ],
];
