<?php

namespace Incraigulous\AdminZone\Singles;

use Incraigulous\AdminZone\Contracts\SingleInterface;
use Incraigulous\AdminZone\Item;
use Incraigulous\AdminZone\MenuItems\MenuItem;

abstract class Single extends MenuItem implements SingleInterface
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
