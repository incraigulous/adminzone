<?php

namespace Incraigulous\AdminZone\Fields;


use Illuminate\Support\Collection;

/**
 * Class SelectField
 */
class SelectField extends Field
{
    protected $options = [];

    public function option(string $label, $value): SelectField
    {
        $this->options[$value] = $label;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }


    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();
        $attributes['options'] = $this->getOptions();
        return $attributes;
    }
}
