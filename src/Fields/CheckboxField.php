<?php

namespace Incraigulous\AdminZone\Fields;


use Illuminate\Http\Request;

/**
 * Class CheckboxField
 */
class CheckboxField extends Field
{
    public function prepareSubmission(Request $request, array &$payload)
    {
        $name = $this->name;
        $payload[$name] = ($request->get($name)) ? true : false;
    }
}
