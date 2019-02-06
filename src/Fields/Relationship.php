<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
abstract class Relationship extends Field
{
    protected $relatedTo;
    protected $relationshipName;

    public function relatedTo(string $resource): Relationship
    {
        $this->relatedTo = new $resource;
        return $this;
    }

    public function relationshipName(string $name): Relationship
    {
        $this->relationshipName = $name;
        return $this;
    }

    public function getRelationshipName(): string
    {
        if ($this->relationshipName) {
            return $this->relationshipName;
        }
        $reflect = new \ReflectionClass($this);
        return camel_case($reflect->getShortName());
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
}
