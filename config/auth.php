<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'accountants' => [
                'driver' => 'session',
                'provider' => 'accountants',
            ],
            'shipmentmanager' => [
                'driver' => 'session',
                'provider' => 'shipmentmanager',
            ],
            'ordermanager' => [
                'driver' => 'session',
                'provider' => 'ordermanager',
            ],
            'stockmanager' => [
                'driver' => 'session',
                'provider' => 'stockmanager',
            ],
            'suppliers' => [
                'driver' => 'session',
                'provider' => 'suppliers',
            ],
            'drivers' => [
                'driver' => 'session',
                'provider' => 'drivers',
            ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'accountants' => [
            'driver' => 'eloquent',
            'model' => App\accountants::class,
        ],
        'drivers' => [
            'driver' => 'eloquent',
            'model' => App\drivers::class,
        ],
        'shipmentmanager' => [
            'driver' => 'eloquent',
            'model' => App\shipmentmanager::class,
        ],
        'ordermanager' => [
            'driver' => 'eloquent',
            'model' => App\ordermanager::class,
        ],
        'stockmanager' => [
            'driver' => 'eloquent',
            'model' => App\stockmanager::class,
        ],
        'suppliers' => [
            'driver' => 'eloquent',
            'model' => App\suppliers::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'accountants' => [
            'provider' => 'accountants',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'ordermanager' => [
            'provider' => 'ordermanager',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'stockmanager' => [
            'provider' => 'stockmanager',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'shipmentmanager' => [
            'provider' => 'shipmentmanager',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'drivers' => [
            'provider' => 'drivers',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'suppliers' => [
            'provider' => 'suppliers',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
