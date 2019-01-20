<?php

namespace Incraigulous\AdminZone\Traits;

use Spatie\Translatable\HasTranslations;

trait Translatable
{
    use HasTranslations;

    public function getTranslatableAttributes() : array
    {
        return is_array($this->translatable)
        ? $this->translatable
        : config('adminzone.translations');
    }
}
