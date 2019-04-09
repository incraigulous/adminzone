<?php

namespace Incraigulous\AdminZone\Fields;


use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class TextField
 */
class DateField extends Field
{
    public function prepareSubmission(Request $request, array &$payload)
    {
        $name = $this->name;
        if ($request->get($name)) {
            $payload[$name] = Carbon::parse($request->$name);
        } else {
            $payload[$name] = null;
        }
    }
}
