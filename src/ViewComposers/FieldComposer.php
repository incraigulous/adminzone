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
        $entry = $data['entry'] ?? null;
        $value = $data['value'] ?? null;
        $value = $value ?? old($name);
        $placeholder = $data['placeholder'] ?? null;

        if (!isset($placeholder)) {
            $placeholder = (isset($label)) ? $label : ucwords(str_replace_last('_', ' ', $name));
        }
        $attributes = $attributes ?? [
                'class' => AdminZone::helpers()->classes($data['class'] ?? ''),
                'name' => $name,
                'placeholder' => $placeholder,
                'data-target' => $data['dataTarget'] ?? '',
                'data-action' => $data['dataAction'] ?? '',
                'data-validation-name' => $validationName
            ];
        $tip = $tip ?? '';
        $error = $error ?? '';
        $label = $label ?? '';
        $before = $before ?? '';

        $view->with('name', $name);
        $view->with('label', $label);
        $view->with('placeholder', $placeholder);
        $view->with('validationName', $validationName);
        $view->with('attributes', $attributes);
        $view->with('tip', $tip);
        $view->with('error', $error);
        $view->with('label', $label);
        $view->with('before', $before);
        $view->with('value', $value);
        $view->with('entry', $entry);
    }
}
