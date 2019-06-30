<?php

return [

    'default' => [
        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC Scheme
        |--------------------------------------------------------------------------
        | URI scheme of Growthcoin Core's JSON-RPC server.
        |
        | Use 'https' scheme for SSL connection.
        | Note that you'll need to setup secure tunnel or reverse proxy
        | in order to access Growthcoin Core via SSL.
        | See: https://bitcoin.org/en/release/v0.12.0#rpc-ssl-support-dropped
        |
        */

        'scheme' => env('GROWTHCOIND_SCHEME', 'http'),

        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC Host
        |--------------------------------------------------------------------------
        | Tells service provider which hostname or IP address
        | Growthcoin Core is running at.
        |
        | If Growthcoin Core is running on the same PC as
        | laravel project use localhost or 127.0.0.1.
        |
        | If you're running Growthcoin Core on the different PC,
        | you may also need to add rpcallowip=<server-ip-here> to your growthcoin.conf
        | file to allow connections from your laravel client.
        |
        */

        'host' => env('GROWTHCOIND_HOST', 'localhost'),

        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC Port
        |--------------------------------------------------------------------------
        | The port at which Growthcoin Core is listening for JSON-RPC connections.
        | Default is 17178 for mainnet and 27178 for testnet.
        | You can also directly specify port by adding rpcport=<port>
        | to growthcoin.conf file.
        |
        */

        'port' => env('GROWTHCOIND_PORT', 17178),

        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC User
        |--------------------------------------------------------------------------
        | Username needs to be set exactly as in growthcoin.conf file
        | rpcuser=<username>.
        |
        */

        'user' => env('GROWTHCOIND_USER', ''),

        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC Password
        |--------------------------------------------------------------------------
        | Password needs to be set exactly as in growthcoin.conf file
        | rpcpassword=<password>.
        |
        */

        'password' => env('GROWTHCOIND_PASSWORD', ''),

        /*
        |--------------------------------------------------------------------------
        | Growthcoind JSON-RPC Server CA
        |--------------------------------------------------------------------------
        | If you're using SSL (https) to connect to your Growthcoin Core
        | you can specify custom ca package to verify against.
        | Note that you'll need to setup secure tunnel or reverse proxy
        | in order to access Growthcoin Core via SSL.
        | See: https://bitcoin.org/en/release/v0.12.0#rpc-ssl-support-dropped
        |
        */

        'ca' => null,

        /*
        |--------------------------------------------------------------------------
        | Preserve method name case.
        |--------------------------------------------------------------------------
        | Keeps method name case as defined in code when making a request,
        | instead of lowercasing them.
        | When this option is set to true, bitcoind()->getBlock()
        | request will be sent to server as 'getBlock', when set to false
        | method name will be lowercased to 'getblock'.
        | For Growthcoin Core leave as default(false), for ethereum
        | JSON-RPC API this must be set to true.
        |
        */
        'preserve_case' => false,

        /*
        |--------------------------------------------------------------------------
        | Growthcoind ZeroMQ options
        |--------------------------------------------------------------------------
        | Used to subscribe to zeromq topics pushed by daemon.
        | In order to use this you mush install "denpa\laravel-zeromq" package,
        | have Growthcoin Core with zeromq support included and have zmqpubhashtx,
        | zmqpubhashblock, zmqpubrawblock and zmqpubrawtx options defined
        | in bitcoind.conf.
        | For more information
        | visit https://laravel-bitcoinrpc.denpa.pro/docs/zeromq/
        |
        */

        'zeromq' => [
            'host' => 'localhost',
            'port' => 0,
        ],
    ],

    // Add other connections
    // 'litecoin' => [
    //     'scheme'        => 'http',
    //     'host'          => 'localhost',
    //     'port'          => 9332,
    //     'user'          => '',
    //     'password'      => '',
    //     'ca'            => null,
    //     'preserve_case' => false,
    //     'zeromq'        => null,
    // ],
];
