<?php

namespace Incraigulous\AdminZone\Repositories;


use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;

/**
 * Class RepositoryBase
 */
abstract class Repository implements RepositoryInterface
{
    public $filters = [];

    public function revisions($id): Collection
    {
        return objection([]);
    }

    public function setFilters(array $filters): RepositoryInterface
    {
        $this->filters = $filters;
        return $this;
    }

    protected function hasFilters()
    {
        return count($this->filters) > 0;
    }

    protected function filterQuery($query) {
        foreach($this->filters as $key => $filter)
        {
            if (!empty(request()->filters[$key])) {
                $query = $filter->apply(request(), $query, request()->filters[$key]);
            }
        }

        return $query;
    }
}
