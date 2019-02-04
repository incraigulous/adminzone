<?php

namespace Incraigulous\AdminZone\Resources;


use Illuminate\Pagination\LengthAwarePaginator;
use Incraigulous\AdminZone\AdminZone;
use Incraigulous\Objection\Collection;
use Incraigulous\Objection\DataTransferObject;

/**
 * Class Repository
 */
class ResourcesRepository
{
    public static function getSearchableResources(): Collection
    {
        $resources = AdminZone::resources();
        return $resources->filter(function(Resource $resource) {
            return $resource->isSearchable();
        });
    }

    public static function search(string $query, array $resourcesSlugs = []): Collection
    {
        $resources = static::getSearchableResources()->filter(function($resource) use ($resourcesSlugs) {
            if (!count($resourcesSlugs)) return true;
            return in_array($resource->getSlug(), $resourcesSlugs);
        });

        $results = $resources->reduce(function($collection, Resource $resource) use ($query) {
            $results = $resource->search($query);

            if ($results->count()) {
                $collection->push(objection([
                    'resource' => $resource,
                    'results' => $results
                ]));
            }

            return $collection;
        }, new Collection([]));

        return $results;
    }
}
