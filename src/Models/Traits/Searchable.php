<?php
/**
 * Searchable.php
 */

namespace Incraigulous\AdminZone\Models\Traits;

use Nicolaslopezj\Searchable\SearchableTrait;

trait Searchable
{
    use SearchableTrait;

    public function getSearchableAttribute()
    {
        return [
            'columns' => [
                'label' => 10
            ]
        ];
    }
}
