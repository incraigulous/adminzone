<?php

namespace Incraigulous\AdminZone\Filters;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\FilterInterface;
use Incraigulous\AdminZone\Item;

/**
 * Class ModelFilter
 */
abstract class Filter extends Item implements FilterInterface
{
    public $options;
    public $label;

    public function type(): string
    {
       return 'filter';
    }

    protected function asArray(): array
    {
        return [
            'options' => $this->options(),
            'default' => $this->getDefault()
        ];
    }
}
