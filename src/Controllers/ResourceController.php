<?php

namespace Incraigulous\AdminZone\Controllers;


use Incraigulous\AdminZone\AdminZone;

/**
 * Class ResourceController
 */
class ResourceController extends Controller
{
    public function index($slug) {
        $resource = AdminZone::findResource($slug);
        if (!$resource) {
            return abort(404);
        }
        $items = $resource->getRepository()->paginate();
        return view('adminzone::resources.index', compact('resource', 'items'));
    }
}
