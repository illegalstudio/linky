<?php

return [
    'home_slug' => '@',
    'auth'      => [
        'name'         => 'linky',
        'enabled'      => false,
        'require_user' => false,
        'multi_tenant' => false,
        'disable'      => [
            'registration'       => false,
            'forgot_password'    => false,
            'email_verification' => false,
            'user_profile'       => false,
        ]
    ],
    'db'        => [
        'prefix' => 'linky_'
    ]
];
