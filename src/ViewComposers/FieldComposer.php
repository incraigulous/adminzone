<?php

namespace Incraigulous\AdminZone\ViewComposers;

use Illuminate\View\View;
use Incraigulous\AdminZone\AdminZone;

/**
 * Class FieldComposer
 */
class FieldComposer
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

        $name =  $data['name'] ?? '';
        $validationName = $validationName ?? $name;
        $label = $data['label'] ?? '';
        $value = $data['value'] ?? old($name);

        if (!isset($placeholder)) {
            $placeholder = (isset($label)) ? $label : ucwords(str_replace_last('_', ' ', $name));
        }
        $attributes = $attributes ?? [
                'class' => AdminZone::helpers()->classes($data['class'] ?? '', 'form-control'),
                'name' => $data['name'] ?? '',
                'placeholder' => $placeholder,
                'data-target' => $data['dataTarget'] ?? '',
                'data-action' => $data['dataAction'] ?? '',
                'data-validation-name' => $validationName
            ];
        $tip = $tip ?? '';
        $error = $error ?? '';
        $label = $label ?? '';
        $prepend = $prepend ?? '';

        $view->with('name', $name);
        $view->with('label', $label);
        $view->with('placeholder', $placeholder);
        $view->with('validationName', $validationName);
        $view->with('attributes', $attributes);
        $view->with('tip', $tip);
        $view->with('error', $error);
        $view->with('label', $label);
        $view->with('prepend', $prepend);
        $view->with('value', $value);
    }
}
