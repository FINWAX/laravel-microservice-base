<?php

use MGGFLOW\LVMSVC\Auth\Zitadel\Config;
use function MGGFLOW\LVMSVC\FileSystem\load_json_from_root;


return [
    'zitadel_config' => new Config(
        authDomain: env('MSVC_AUTH_DOMAIN'),
        introspectionUrl: env('MSVC_AUTH_INTROSPECTION_URL'),
        projectId: env('MSVC_PROJECT_ID'),
        basicAuthClientId: env('MSVC_AUTH_BASIC_CLIENT_ID'),
        basicAuthClientSecret: env('MSVC_AUTH_BASIC_CLIENT_SECRET'),
        JWTClientId: env('MSVC_AUTH_JWT_CLIENT_ID'),
        JWTPrivateKeyData: load_json_from_root(env('MSVC_AUTH_JWT_PRIVATE_KEY_FILE_PATH', ''), false),
        personalAccessToken: env('MSVC_AUTH_PAT'),
        tokenIntrospectionPeriod: env('MSVC_AUTH_TOKEN_INTROSPECTION_PERIOD', 10 * 60),
        JWTKeyAlgorithm: 'RS256'
    ),

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
