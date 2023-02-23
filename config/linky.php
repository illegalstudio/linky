<?php

return [
    'home_slug' => env('LINKY_HOME_SLUG', '@'),
    'auth'      => [
        'use_linky_auth'     => env('LINKY_AUTH_USE_LINKY_AUTH', true),
        'require_valid_user' => env('LINKY_AUTH_REQUIRE_VALID_USER', true),
        'login_route_name'   => env('LINKY_AUTH_LOGIN_ROUTE_NAME', 'login'),
    ],
    'db'        => [
        'prefix' => env('LINKY_DB_PREFIX', 'linky_'),
    ]
];
