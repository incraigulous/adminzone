<?php

namespace Incraigulous\AdminZone\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Class ExampleFilter
 */
class ExampleModelFilter extends ModelFilter
{

    public function options(): array
    {
        return [
            'active' => true,
            'inactive' => false
        ];
    }

    public function apply(Request $request, Builder $query, $value)
    {
        return $query->where('isActive', $value);
    }
}
