<?php

return [
    'path' => 'admin',
    'middleware' => 'auth',
    'registrationFile' => base_path('adminzone'),
    'menu' => [
        \Incraigulous\AdminZone\Resources\SearchableUser::class
    ],
    'translations' => ['en', 'es'],
    'copyright' => 'Proudly created by <a href="http://www.github.com/incraigulous/">@incraigulous</a> from <a href="https://codezone.io">CodeZone</a>. I worked really hard on this! <a href="https://www.paypal.me/incraigulous">Give me a tip</a>?',
    'filesystem' => 'public',
    'logo' => null

];
