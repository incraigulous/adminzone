<?php

namespace Incraigulous\AdminZone\Filters;


use BenTools\QueryString\QueryString;
use Illuminate\Http\Request;
/**
 * Class ExampleFilter
 */
class ExampleQueryStringFilter extends QueryStringFilter
{

    public function options(): array
    {
        return [
            'active' => true,
            'inactive' => false
        ];
    }

    public function apply(Request $request, QueryString $query, $value)
    {
        return $query->withParam('isActive', $value);
    }
}
