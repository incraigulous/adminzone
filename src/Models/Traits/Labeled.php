<?php

namespace Incraigulous\AdminZone\Models\Traits;


/**
 * Trait Labeled
 */
trait Labeled
{
    protected $labelField = 'label';
    protected $descriptionField = 'description';

    public function getLabelAttribute()
    {
        $fieldName = $this->labelField;

        if ($this->hasAttribute($fieldName)) {
            return $this->$fieldName;
        }
    }

    public function getDescriptionAttribute()
    {
        $fieldName = $this->descriptionField;

        if ($this->hasAttribute($fieldName)) {
            return $this->$fieldName;
        }
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }
}
