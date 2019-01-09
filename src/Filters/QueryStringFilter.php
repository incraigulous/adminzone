<?php

namespace Incraigulous\AdminZone\Filters;


use BenTools\QueryString\QueryString;
use Illuminate\Http\Request;

/**
 * Class QueryStringFilter
 */
abstract class QueryStringFilter extends Filter
{
    abstract public function apply(Request $request, QueryString $query, $value);
}
