<?php

return [

    'default' => env('DB_CONNECTION', 'sqlsrv'),

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => env('DB_PREFIX', ''),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', true),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
        ],

        'pgsql' => [
            'driver'    => env('DB_PG_CONNECTION'),
            'host'      => env('DB_PG_HOST'),
            'port'      => env('DB_PG_PORT'),
            'database'  => env('DB_PG_DATABASE'),
            'username'  => env('DB_PG_USERNAME'),
            'password'  => env('DB_PG_PASSWORD'),
            'charset'   => env('DB_CHARSET'),
            'prefix'    => env('DB_PREFIX'),
            'schema'    => env('DB_SCHEMA'),
            'sslmode'   => env('DB_SSL_MODE'),
            // 'driver' => env('DB_PG_CONNECTION'),
            // 'host' => env('DB_PG_HOST', '127.0.0.1'),
            // 'port' => env('DB_PG_PORT', 5432),
            // 'database' => env('DB_PG_DATABASE', 'forge'),
            // 'username' => env('DB_PG_USERNAME', 'forge'),
            // 'password' => env('DB_PG_PASSWORD', ''),
            // 'charset' => env('DB_CHARSET', 'utf8'),
            // 'prefix' => env('DB_PREFIX', ''),
            // 'schema' => env('DB_SCHEMA', 'public'),
            // 'sslmode' => env('DB_SSL_MODE', 'prefer'),
        ],

        'sqlsrv' => [
            'driver'    => env('DB_CONNECTION'),
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => env('DB_CHARSET'),
            'prefix'    => env('DB_PREFIX'),
            // 'driver' => 'sqlsrv',
            // 'host' => env('DB_HOST', 'localhost'),
            // 'port' => env('DB_PORT', 1433),
            // 'database' => env('DB_DATABASE', 'forge'),
            // 'username' => env('DB_USERNAME', 'forge'),
            // 'password' => env('DB_PASSWORD', ''),
            // 'charset' => env('DB_CHARSET', 'utf8'),
            // 'prefix' => env('DB_PREFIX', ''),
        ],
        // ARTA | START | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
        'dev' => [
            'driver'    => env('DB_CONNECTION'),
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => env('DB_CHARSET'),
            'prefix'    => env('DB_PREFIX'),
            // 'driver' => env('DB_CONNECTION_DEV'),
            // 'host' => env('DB_HOST_DEV', 'localhost'),
            // 'port' => env('DB_PORT_DEV', 1433),
            // 'database' => env('DB_DATABASE_DEV', 'forge'),
            // 'username' => env('DB_USERNAME_DEV', 'forge'),
            // 'password' => env('DB_PASSWORD_DEV', ''),
            // 'charset' => env('DB_CHARSET_DEV', 'utf8'),
            // 'prefix' => env('DB_PREFIX_DEV', ''),
        ],
        // ARTA | END | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025

        // 'devfood' => [
        //     'driver' => env('DB_CONNECTION_DEVFOOD'),
        //     'host' => env('DB_HOST_DEVFOOD', 'localhost'),
        //     'port' => env('DB_PORT_DEVFOOD', 1433),
        //     'database' => env('DB_DATABASE_DEVFOOD', 'forge'),
        //     'username' => env('DB_USERNAME_DEVFOOD', 'forge'),
        //     'password' => env('DB_PASSWORD_DEVFOOD', ''),
        //     'charset' => env('DB_CHARSET_DEVFOOD', 'utf8'),
        //     'prefix' => env('DB_PREFIX_DEVFOOD', ''),
        // ],

        'ftm' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_FINGER', '127.0.0.1'),
            'port' => env('DB_PORT_FINGER', 3306),
            'database' => env('DB_DATABASE_FINGER', 'forge'),
            'username' => env('DB_USERNAME_FINGER', 'forge'),
            'password' => env('DB_PASSWORD_FINGER', ''),
            'unix_socket' => env('DB_SOCKET_FINGER', ''),
            'charset' => env('DB_CHARSET_FINGER', 'utf8'),
            'collation' => env('DB_COLLATION_FINGER', 'utf8_unicode_ci'),
            'prefix' => env('DB_PREFIX_FINGER', ''),
            'strict' => env('DB_STRICT_MODE_FINGER', true),
            'engine' => env('DB_ENGINE_FINGER', null),
            'timezone' => env('DB_TIMEZONE_FINGER', '+00:00'),
        ],

        'zkbio' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST_FINGER_ZKBIO', '192.168.10.3'),
            'port' => env('DB_PORT_FINGER_ZKBIO', 1433),
            'database' => env('DB_DATABASE_FINGER_ZKBIO', 'zkbio'),
            'username' => env('DB_USERNAME_FINGER_ZKBIO', 'superadmin'),
            'password' => env('DB_PASSWORD_FINGER_ZKBIO', 'superadmin'),
            'charset' => env('DB_CHARSET_FINGER_ZKBIO', 'utf8'),
            'prefix' => env('DB_PREFIX_FINGER_ZKBIO', ''),
        ],

    ],


    'migrations' => 'migrations',

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
