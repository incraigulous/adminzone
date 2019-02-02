<?php

namespace Incraigulous\AdminZone\Models;

use Incraigulous\AdminZone\Models\Traits\Searchable;

class SearchableUser extends User {
    use Searchable;

    protected $table = 'users';
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.email' => 9,
        ],
    ];
}
