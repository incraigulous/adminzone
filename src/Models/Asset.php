<?php

namespace Incraigulous\AdminZone\Models;

use Incraigulous\AdminZone\Models\Traits\Searchable;

class Asset extends Model
{
    use Searchable;

    protected $labelField = 'title';
    protected $descriptionField = 'filename';
    protected $searchable = [
        'columns' => [
            'filename' => 9,
            'title' => 10
        ],
    ];

    public function getTypeAttribute()
    {
        $takeFirst = ['image', 'video'];
        $parts = explode("/", $this->mime, 2);
        if (in_array($parts[0], $takeFirst)) {
            return $parts[0];
        }
        return $parts[1];
    }
}
