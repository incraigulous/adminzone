<?php

namespace Incraigulous\AdminZone\ViewComposers;

use Illuminate\View\View;
use Incraigulous\AdminZone\AdminZone;

/**
 * Class FieldComposer
 */
class FieldElementComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        $name = $data['name'] ?? null;
        $entry = $data['entry'] ?? null;
        $value = $data['value'] ?? null;
        $field = $data['field'] ?? null;

        if ($field && !$name) {
            $name = $field->getName();
        }
        $value = $value ? $value : old($name);

        if ($entry && $name && !$value) {
            $value = $entry->$name;
        }

        $view->with('name', $name);
        $view->with('value', $value);
    }
}
