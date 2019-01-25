<?php

return [
    'path' => 'admin',
    'middleware' => 'auth',
    'registrationFile' => base_path('adminzone'),
    'menu' => [
        \Incraigulous\AdminZone\Resources\User::class
    ],
    'translations' => ['en', 'es']
];
