<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Http\Request;

interface FilterInterface extends ItemInterface
{
    public function options(): array;
    public function apply(Request $request, $query, $value);
}
