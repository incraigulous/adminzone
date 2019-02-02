<?php

namespace Incraigulous\AdminZone\Models;


use Illuminate\Support\Facades\Schema;
use Incraigulous\AdminZone\Models\Traits\Labeled;

/**
 * Class Model
 */
class Model extends \Illuminate\Database\Eloquent\Model
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
