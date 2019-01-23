<?php

namespace Incraigulous\AdminZone\Models;

use Spatie\Translatable\HasTranslations;

class TranslatableUser extends User {
    use HasTranslations;

    protected $table = 'users';
}
