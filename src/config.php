<?php

return [

    /**
     * The MultiversX blockchain network you want to interact with:
     * - Mainnet: 1
     * - Testnet: T
     * - Devnet: D
     */
    'chain_id' => env('MULTIVERSX_CHAIN_ID', '1'),

    'block_time' => env('MULTIVERSX_BLOCK_TIME', 6),

    'urls' => [

        /**
         * The base url of the MultiversX API (not Proxy).
         * e.g:
         * - Mainnet: https://api.elrond.com
         * - Testnet: https://testnet-api.elrond.com
         * - Devnet: https://devnet-api.elrond.com
         */
        'api' => env('MULTIVERSX_URL_API', 'https://api.multiversx.com'),

        'explorer' => env('MULTIVERSX_URL_EXPLORER', 'https://explorer.elrond.com'),
    ],

    'native_auth' => [
        'api_url' => env('MULTIVERSX_NATIVEAUTH_APIURL', 'https://api.multiversx.com'),

        'accepted_origins' => [
            'https://api.multiversx.com',
        ],

        'max_expiry_seconds' => 86400,

        'skip_legacy_validation' => false,
    ],
];
