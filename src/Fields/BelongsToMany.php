<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
class BelongsToMany extends Relationship
{
    public function prepareSubmission(Request $request, array &$payload)
    {
      // Do nothing
    }

    public function afterSubmission(Request $request, $entry, RepositoryInterface $repository)
    {

        if ($request->has($this->name)) {
            $request->sync($entry->id, $this->getRelationshipName(), $request->get($this->name));
        }
    }
}
