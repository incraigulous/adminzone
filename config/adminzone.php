<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Path
    |--------------------------------------------------------------------------
    |
    | Specify the URI for the admin root.
    |
    */

    'path' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Admin Middleware
    |--------------------------------------------------------------------------
    |
    | Which middleware should adminzone use?
    | This will apply to all adminzone routes.
    |
    */
    'middleware' => 'auth',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | Add resources to admin sidebar. Resources must implement
    | Incraigulous\AdminZone\Contracts\ResourceInterface
    | For the default implementation extend
    | Incraigulous\AdminZone\Resources\Resource
    */
    'resources' => [
        \Incraigulous\AdminZone\Resources\SearchableUser::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Translations
    |--------------------------------------------------------------------------
    |
    | Translations aren't utilized yet, but will be in the future.
    | For now, they are just a placeholder for now.
    |
    */
    'translations' => ['en', 'es'],

    /*
    |--------------------------------------------------------------------------
    | Copyright content
    |--------------------------------------------------------------------------
    |
    | If you aren't extending the base view, this message shows up in the footer
    |
    */
    'copyright' => 'Proudly created by <a href="http://www.github.com/incraigulous/">@incraigulous</a> from <a href="https://codezone.io">CodeZone</a>. I worked really hard on this! <a href="https://www.paypal.me/incraigulous">Give me a tip</a>?',

    /*
    |--------------------------------------------------------------------------
    | Filesystem
    |--------------------------------------------------------------------------
    |
    | Which filesystem (config.filesystems) should uploaded assets use?
    |
    */
    'filesystem' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Provide a path to the logo. It will show up at the top, left.
    |
    */
    'logo' => null
];
