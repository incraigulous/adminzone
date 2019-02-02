<?php

namespace Incraigulous\AdminZone\Controllers;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Incraigulous\AdminZone\AdminZone;

/**
 * Class ResourceController
 */
class ResourceController extends Controller
{
    use ValidatesRequests;

    public function show($slug, $id) {
        $resource = AdminZone::findResource($slug);
        $entry = $resource->getRepository()->find($id);
        if (!$resource || !$entry) {
            return abort(404);
        }
        return view('adminzone::resources.show', compact('resource', 'entry'));
    }

    public function index(Request $request, $slug) {
        $resource = AdminZone::findResource($slug);
        if (!$resource) {
            return abort(404);
        }
        if ($request->get('q')) {
            $items = $resource->getRepository()->search(
                $request->get('q')
            );
        } else {
            $items = $resource->getRepository()->paginate();
        }
        return view('adminzone::resources.index', compact('resource', 'items'));
    }

    public function edit($slug, $id) {
        $resource = AdminZone::findResource($slug);
        $entry = $resource->getRepository()->find($id);
        if (!$resource || !$entry) {
            return abort(404);
        }
        return view('adminzone::resources.edit', compact('resource', 'entry'));
    }

    public function update(Request $request, $slug, $id) {
        $resource = AdminZone::findResource($slug);
        $form = $resource->getEditForm();
        $this->validate($request, $form->getRules());
        $form->getSubmission()->submit($request, $resource->getRepository());
        return redirect()->back()->with(
            [
                'alert-message' => $form->getSuccessMessage(),
                'alert-theme' => 'success'
            ]);
    }

    public function create($slug) {
        $resource = AdminZone::findResource($slug);
        if (!$resource) {
            return abort(404);
        }
        return view('adminzone::resources.create', compact('resource'));
    }

    public function store(Request $request, $slug) {
        $resource = AdminZone::findResource($slug);
        $form = $resource->getCreateForm();
        $this->validate($request, $form->getRules());
        $result = $form->getSubmission()->submit($request, $resource->getRepository());
        return redirect()->route($resource->getEditRoute(), [
            'slug' => $resource->getSlug(),
            'id' => $result->id
        ])->with(
                [
                    'alert-message' => $form->getSuccessMessage(),
                    'alert-theme' => 'success'
                ]
        );
    }

    public function destroy(Request $request, $slug) {
        $resource = AdminZone::findResource($slug);
        $submission = $resource->getDestroySubmission();
        $submission->submit($request, $resource->getRepository());
        return redirect()->route($resource->getRoute(), [
            'slug' => $resource->getSlug()
        ])->with(
            [
                'alert-message' => "The {$resource->getLabel()} was deleted.",
                'alert-theme' => 'success'
            ]
        );
    }
}
