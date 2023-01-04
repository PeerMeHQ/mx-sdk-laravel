<?php

return [

    /**
     * The MultiversX blockchain network you want to interact with:
     * - Mainnet: 1
     * - Testnet: T
     * - Devnet: D
     */
    'chain_id' => env('MULTIVERSX_CHAIN_ID', '1'),

    'urls' => [

        /**
         * The base url of the MultiversX API (not Proxy).
         * e.g:
         * - Mainnet: https://api.elrond.com
         * - Testnet: https://testnet-api.elrond.com
         * - Devnet: https://devnet-api.elrond.com
         */
        'api' => env('MULTIVERSX_URL_API', 'https://api.elrond.com'),

        'explorer' => env('MULTIVERSX_URL_EXPLORER', 'https://explorer.elrond.com'),
    ],
];
