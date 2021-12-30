<?php

return [

    /**
     * the elrond blockchain network you want to interact with:
     * - 1 for mainnet
     * - T for testnet
     * - D for devnet
     */
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

    'prepared-txs' => [
        'issueNftCollection' => \Superciety\ElrondSdk\PreparedTxs\IssueNftCollectionTxBuilder::class,
        'setNftCollectionRoles' => \Superciety\ElrondSdk\PreparedTxs\SetNftCollectionRolesTxBuilder::class,

    'vm_queries' => [
        // ...
    ],

    'ipfs' => [

        'provider' => \Superciety\ElrondSdk\Ipfs\PinataProvider::class,

        'providers' => [

            'pinata' => [

                'bearer_token' => env('PINATA_BEARER_TOKEN'),
            ],
        ],
    ],
];
