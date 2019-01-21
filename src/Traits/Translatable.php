<?php

namespace Incraigulous\AdminZone\Traits;

use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Config;

trait Translatable
{
    use HasTranslations;

    public function getTranslatableAttributes() : array
    {
        return is_array($this->translatable)
        ? $this->translatable
        : Config::get('adminzone.translations');
    }
}
