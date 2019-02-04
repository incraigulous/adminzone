<?php

namespace Incraigulous\AdminZone\Models\Traits;

use Illuminate\Support\Facades\Schema;

trait Administratable
{
    use Labeled;

    public function availableFields()
    {
        if (property_exists($this, 'fields')) {
            return $this->fields;
        }

        return Schema::getColumnListing($this->getTable());
    }
}
