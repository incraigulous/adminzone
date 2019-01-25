<?php

namespace Incraigulous\AdminZone\Controllers;


use Incraigulous\AdminZone\AdminZone;

/**
 * Class ResourceController
 */
class ResourceController
{
    public function show($slug) {
        $resource = AdminZone::findResource($slug);
        if (!$resource) {
            return abort(404);
        }
        $resource = $resource->toObject();
        return view('adminzone::resources.show', compact('resource'));
    }
}
