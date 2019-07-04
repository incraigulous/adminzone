<?php

namespace Incraigulous\AdminZone\Models;


use Illuminate\Support\Facades\Schema;
use Incraigulous\AdminZone\Models\Traits\Administratable;
use Incraigulous\AdminZone\Models\Traits\Labeled;

/**
 * Class Model
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use Administratable;

    protected $labelField = 'label';
    protected $descriptionField = 'description';
}
