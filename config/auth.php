<?php

return [



    'defaults' => [
        'guard' => 'user',
        'passwords' => 'users',
    ],



    'guards' => [
        'user' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admins',
            'hash' => false,
        ],
    ],



    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => 10800,

];
