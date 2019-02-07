<?php

namespace Incraigulous\AdminZone\Controllers;

use Incraigulous\AdminZone\AdminZone;

/**
 * Class ResourceController
 */
class FieldController extends Controller
{
    public function show($slug, $id) {
        $resource = AdminZone::findResource($slug);

        $entry = !is_null($id) ? $resource->getRepository()->find($id) : null;
        $name = request()->get('name');
        $value = request()->get('value') ? request()->get('value') : 'delete';
        $form = !is_null($id) ? $resource->getEditForm() : $resource->getCreateForm();
        $field = collect($form->getFields())->first(function($field) use ($name) {
            return $field->getName() === $name;
        });
        if (!$field) {
            return abort(404);
        }

        return view('adminzone::elements.fields.' . $field->getSlug(), compact('entry', 'field', 'value', 'resource', 'relatedTo'));
    }
}
