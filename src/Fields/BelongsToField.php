<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
class BelongsToField extends Relationship
{
    public function prepareSubmission(Request $request, array &$payload)
    {
        $payload[$this->name. '_id'] = $request->get($this->name);
        return $payload;
    }
}
