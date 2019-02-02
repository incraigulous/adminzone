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
}
