<?php

namespace Incraigulous\AdminZone\Singles;

use Incraigulous\AdminZone\Contracts\SingleInterface;
use Incraigulous\AdminZone\Item;

abstract class Single extends Item implements SingleInterface
{
    public function type(): string
    {
        return 'single';
    }

    public function asArray(): array
    {
        return [
            'data' => $this->data()->toArray()
        ];
    }
}
