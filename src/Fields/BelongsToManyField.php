<?php

namespace Incraigulous\AdminZone\Fields;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Resources\Resource;

/**
 * Class BelongsToField
 */
class BelongsToManyField extends Relationship
{
    public function prepareSubmission(Request $request, array &$payload)
    {
      // Do nothing
    }

    public function afterSubmission(Request $request, $entry, RepositoryInterface $repository)
    {
        $ids = collect($request->has($this->name) ? $request->get($this->name) : []);
        $values = $ids->reduce(function($carry, $v)  {
            $carry[$v] = ['order' => count($carry) + 1];
            return $carry;
        }, []);
        $repository->sync($entry->id, $this->getName(), $values);
    }
}
