<?php

return [
    'home_slug'       => env('LINKY_HOME_SLUG', '@'),
    'slug_min_length' => env('LINKY_SLUG_MIN_LENGTH', 5),
    'auth'            => [
        'inside_auth_name'   => env('LINKY_AUTH_INSIDE_AUTH_NAME', 'linky'),
        'use_linky_auth'     => env('LINKY_AUTH_USE_LINKY_AUTH', true),
        'require_valid_user' => env('LINKY_AUTH_REQUIRE_VALID_USER', true),
        'multi_tenant'       => env('LINKY_AUTH_MULTI_TENANT', false),
        'functionalities'    => [
            'register'           => env('LINKY_AUTH_FUNCTIONALITIES_REGISTER', true),
            'forgot_password'    => env('LINKY_AUTH_FUNCTIONALITIES_FORGOT_PASSWORD', true),
            'email_verification' => env('LINKY_AUTH_FUNCTIONALITIES_EMAIL_VERIFICATION', true),
            'user_profile'       => env('LINKY_AUTH_FUNCTIONALITIES_USER_PROFILE', true),
        ]
    ],
    'db'              => [
        'prefix' => env('LINKY_DB_PREFIX', 'linky_'),
    ]
];
