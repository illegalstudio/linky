<?php

return [
    'home_slug' => env('LINKY_HOME_SLUG', '@'),
    'auth'      => [
        'use_linky_auth'     => env('LINKY_AUTH_USE_LINKY_AUTH', true),
        'require_valid_user' => env('LINKY_AUTH_REQUIRE_VALID_USER', true),
        'multi_tenant'       => env('LINKY_AUTH_MULTI_TENANT', false),
        'login_route_name'   => env('LINKY_AUTH_LOGIN_ROUTE_NAME', 'login'),
        'functionalities'    => [
            'register'           => env('LINKY_AUTH_FUNCTIONALITIES_REGISTER', true),
            'forgot_password'    => env('LINKY_AUTH_FUNCTIONALITIES_FORGOT_PASSWORD', true),
            'reset_password'     => env('LINKY_AUTH_FUNCTIONALITIES_RESET_PASSWORD', true),
            'email_verification' => env('LINKY_AUTH_FUNCTIONALITIES_EMAIL_VERIFICATION', true),
            'user_profile'       => env('LINKY_AUTH_FUNCTIONALITIES_USER_PROFILE', true),
        ]
    ],
    'db'        => [
        'prefix' => env('LINKY_DB_PREFIX', 'linky_'),
    ]
];
