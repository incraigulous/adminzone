<?php

namespace Incraigulous\AdminZone\Fields;


use Illuminate\Http\Request;

/**
 * Class EmailField
 */
class PasswordField extends Field
{
    public function handleSubmission(Request $request, array &$payload)
    {
        $name = $this->name;
        if ($request->has($request->$name)) {
            $payload[$name] = bcrypt($request->$name);
        }
        return $payload;
    }
}
