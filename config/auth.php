<?php

return [


    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'etudiants', // Utilisez le provider correspondant aux étudiants
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'administrateurs', // Utilisez le provider correspondant aux administrateurs
        ],
        'etudiant' => [
            'driver' => 'session',
            'provider' => 'etudiants', // Changez 'etudiants' par le nom réel du fournisseur pour les étudiants
        ],
    ],



    'providers' => [


        'etudiants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Etudiant::class,
        ],

        'administrateurs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrateur::class,
        ],
    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => 10800,

];
