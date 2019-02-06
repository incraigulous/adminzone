<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
class BelongsToField extends Field
{
    protected $relatedTo;

    public function relatedTo(string $resource): BelongsToField
    {
        $this->relatedTo = new $resource;
        return $this;
    }

    public function getRelatedTo(): Resource
    {
        return $this->relatedTo;
    }

    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();
        $attributes['relatedTo'] = $this->getRelatedTo();
        return $attributes;
    }

    public function handleSubmission(Request $request, array &$payload)
    {
        $payload[$this->name. '_id'] = $request->get($this->name);
        return $payload;
    }
}
