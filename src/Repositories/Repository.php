<?php

namespace Incraigulous\AdminZone\Repositories;


/**
 * Class RepositoryBase
 */
class Repository
{
    public $filters = [];

    public function setFilters(array $filters)
    {
        $this->filters = $filters;
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
