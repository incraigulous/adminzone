<?php

namespace Incraigulous\AdminZone\Models;

use Incraigulous\AdminZone\Models\Traits\Translatable;

class TranslatableUser extends User {
    use Translatable;

    protected $table = 'users';
}
