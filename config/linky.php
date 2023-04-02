<?php

return [
    'home_slug'       => env('LINKY_HOME_SLUG', '@'),
    'slug_min_length' => env('LINKY_SLUG_MIN_LENGTH', 5),
    'auth'            => [
        'enabled'      => env('LINKY_AUTH_ENABLED', true),
        'name'         => env('LINKY_AUTH_NAME', 'linky'),
        'require_user' => env('LINKY_AUTH_REQUIRE_USER', true),
        'multi_tenant' => env('LINKY_AUTH_MULTI_TENANT', false),
        'disable'      => [
            'registration'       => env('LINKY_AUTH_DISABLE_REGISTRATION', false),
            'forgot_password'    => env('LINKY_AUTH_DISABLE_FORGOT_PASSWORD', false),
            'email_verification' => env('LINKY_AUTH_DISABLE_EMAIL_VERIFICATION', false),
            'user_profile'       => env('LINKY_AUTH_DISABLE_USER_PROFILE', false),
        ]
    ],
    'db'              => [
        'prefix' => env('LINKY_DB_PREFIX', 'linky_'),
    ]
];
