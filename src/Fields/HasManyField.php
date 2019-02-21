<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
class HasManyField extends Relationship
{
    public function prepareSubmission(Request $request, array &$payload)
    {
      // Do nothing
    }

    public function afterSubmission(Request $request, $entry, RepositoryInterface $repository)
    {
        $ids = $request->has($this->name) ? $request->get($this->name) : [];
        $repository->syncHasMany($entry->id, $this->getName(), $ids);
    }
}
