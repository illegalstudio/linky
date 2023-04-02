<?php

return [
    'home_slug' => '@',
    'auth'      => [
        'inside_auth_name'   => 'linky',
        'use_linky_auth'     => true,
        'require_valid_user' => true,
        'multi_tenant'       => false,
    ],
    'db'        => [
        'prefix' => 'linky_'
    ]
];
