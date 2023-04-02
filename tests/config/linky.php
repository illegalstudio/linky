<?php

return [
    'home_slug' => '@',
    'auth'      => [
        'name'         => 'linky',
        'enabled'      => true,
        'require_user' => true,
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
