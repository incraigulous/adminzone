<?php

namespace Incraigulous\AdminZone\Models;

/**
 * Class Revisions
 */
class Revision extends Model
{
    public $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public function getDataAttribute($data)
    {
        return objection(json_decode($data, true));
    }

    public function restore()
    {
        $class = $this->revisionable_type;
        $model = $class::find($this->revisionable_id);
        $model->fill($this->data->toArray());
        $model->save();
    }
}
