<?php

return [

    'defaults' => [
        'guard' => 'miembro', // ← El guard "principal" por defecto
        'passwords' => 'miembros',
    ],

    'guards' => [

        'miembro' => [
            'driver' => 'session',
            'provider' => 'miembros',
        ],

        'bibliotecario' => [
            'driver' => 'session',
            'provider' => 'bibliotecarios',
        ],
    ],

    'providers' => [
        
        'miembros' => [
            'driver' => 'eloquent',
            'model' => App\Models\Miembro::class,
        ],

        'bibliotecarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Bibliotecario::class,
        ],
    ],

    'passwords' => [
        'miembros' => [
            'provider' => 'miembros',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'bibliotecarios' => [
            'provider' => 'bibliotecarios',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
