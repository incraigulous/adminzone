<?php

namespace Incraigulous\AdminZone\Controllers;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\Elements;

/**
 * Class ResourceController
 */
class RelationshipController extends Controller
{
    public function index(Request $request, $slug) {
        $resource = AdminZone::findResource($slug);
        $entries = $resource->getRepository()->search(
            (string) request()->get('q')
        );
        if (!$resource) {
            return abort(404);
        }
        return view('adminzone::relationships.index', ['resource' => $resource, 'entries' => $entries]);
    }
}
