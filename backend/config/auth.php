<?php

return [


    'defaults' => [
        // 'guard' => env('AUTH_GUARD', 'api'),
        'guard' => 'api',
        'passwords' => 'users',
    ],
    'guards' => [
        // 'api' => ['driver' => 'api'],
        'api' => [
            'driver' => 'jwt',
            // 'driver' => 'passport',
            'provider' => 'users',
        ],
        'sales' => [
            'driver' => 'custom-token',
            'provider' => 'user-sales',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\User::class
        ],
        'user-sales' => [
            'driver' => 'eloquent',
            'model' => \App\MstSalesHp::class
        ]
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
