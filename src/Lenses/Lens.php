<?php

namespace Incraigulous\AdminZone\Lenses;

use Incraigulous\AdminZone\Contracts\LensInterface;
use Incraigulous\AdminZone\Item;

abstract class Lens extends Item implements LensInterface
{
    public function type(): string
    {
        return 'lens';
    }

    public function columns(): array
    {
        return [
            'ID' => 'id',
            'Name' => 'name'
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function asArray(): array
    {
        return [
            'data' => $this->data()->toArray(),
            'columns' => objection($this->columns())->toArray(),
            'filters' => objection($this->filters())->toArray()
        ];
    }
}
