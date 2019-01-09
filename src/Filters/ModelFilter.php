<?php

namespace Incraigulous\AdminZone\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Class ModelFilter
 */
abstract class ModelFilter extends Filter
{
    abstract public function apply(Request $request, Builder $query, $value);
}
