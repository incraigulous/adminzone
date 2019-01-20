<?php

return [
    'path' => 'admin',
    'middleware' => 'auth',
    'registrationFile' => base_path('adminzone'),
    'menu' => [
        \Incraigulous\AdminZone\Resources\ExampleResource::class,
        \Incraigulous\AdminZone\Singles\ExampleSingle::class,
        \Incraigulous\AdminZone\MenuItems\MenuItem::class
    ],
    'translations' => ['en', 'es']
];
