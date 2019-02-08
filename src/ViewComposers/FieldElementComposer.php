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
        $field = $data['field'] ?? null;
        $resource = $data['resource'] ?? null;
        $attributes = ($field) ? $field->getAttributes() : [];
        $label = $data['label'] ?? null;
        $slug = $resource ? $resource->getSlug() : null;
        $entryId = ($entry) ? $entry->id : null;
        $value = $data['value'] ?? null;

        if ($field && !$name) {
            $name = $field->getName();
        }
        if ($field && !$label) {
            $label = $field->getLabel();
        }

        if ($value === 'delete') {
            $value = null;
        } elseif (!$value) {
            $value = old($name);

            if ($entry && $name && !$value) {

                $value = $entry->$name;


            }
        }

        if ($view->getName() === 'adminzone::elements.fields.belongs-to-field') {
            if (!empty($value) && !is_object($value)) {
                $value = $field->getRelatedTo()->repository()->find($value);
            }

        }


        if ($view->getName() === 'adminzone::elements.fields.belongs-to-many-field') {
            if (empty($value)) {
                $value = collect([]);
            }

            if (is_array($value)) {
                $value = $field->getRelatedTo()->getRepository()->findMany($value);
            } elseif ($entry) {
                $value = $resource->getRepository()->getManyToMany($entry->id, $name);
            }
        }

        $attributes['name'] = $name;
        $attributes['value'] = $value;
        $attributes['entry'] = $entry;
        $attributes['entryId'] = $entryId;
        $attributes['slug'] = $slug;

        $view->with('label', $label);
        $view->with('attributes', $attributes);
    }
}
