<?php

namespace Incraigulous\AdminZone\MenuItems;

use Incraigulous\AdminZone\Contracts\MenuItemInterface;
use Incraigulous\AdminZone\Item;

class MenuItem extends Item implements MenuItemInterface
{
    protected function type(): string
    {
        return 'menu-item';
    }
}
