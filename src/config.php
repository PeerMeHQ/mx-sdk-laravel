<?php

return [

    /**
     * The MultiversX blockchain network you want to interact with:
     * - 1 for mainnet
     * - T for testnet
     * - D for devnet
     */
    'chain_id' => env('ELROND_CHAIN_ID', '1'),

    'urls' => [

        /**
         * The base url of the MultiversX API (not proxy).
         * Feel free to host your own api for absolute control, or
         * Fall back to the one provided by MultiversX.
         * e.g:
         * - mainnet: https://api.elrond.com
         * - testnet: https://testnet-api.elrond.com
         * - devnet: https://devnet-api.elrond.com
         */
        'api' => env('ELROND_URL_API', 'https://api.elrond.com'),

        'explorer' => env('ELROND_URL_EXPLORER', 'https://explorer.elrond.com'),
    ],

    'ipfs' => [

        'provider' => \Peerme\Multiversx\Ipfs\PinataProvider::class,

        'providers' => [

            'pinata' => [

                'bearer_token' => env('PINATA_BEARER_TOKEN'),
            ],
        ],
    ],
];
