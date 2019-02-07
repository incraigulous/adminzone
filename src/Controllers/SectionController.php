<?php

namespace Incraigulous\AdminZone\Controllers;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\AdminZone;
use Incraigulous\Objection\DataTransferObject;

/**
 * Class ResourceController
 */
class SectionController extends Controller
{
    public function show(Request $request, $slug, $id) {
        $resource = AdminZone::findResource($slug);
        $sectionId = $request->get('section_id');
        $entry = (!empty($id) && $id !== 'new') ? $resource->getRepository()->find($id) : new DataTransferObject([]);
        $form = !is_null($id) ? $resource->getEditForm() : $resource->getCreateForm();
        $section = $form->getSections()->first(function($section) use ($sectionId) {
            return $section->getId() === $sectionId;
        });
        if (!$section) {
            return abort(404);
        }
        $payload = $form->getSubmission()->preparePayload($request, $form->getFields(), $resource->getRepository());
        foreach($payload as $key => $value) {
            $entry->$key = $value;
        }
        return view('adminzone::elements.sections.' . $section->getSlug(), compact('entry', 'section', 'resource'));
    }
}
