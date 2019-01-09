<?php

namespace Incraigulous\AdminZone\MenuItems;

use Incraigulous\AdminZone\Contracts\MenuItemInterface;
use Incraigulous\AdminZone\Item;

class MenuItem extends Item implements MenuItemInterface
{
    public function type(): string
    {
        return 'menu-item';
    }

    public function route()
    {
        return '/' . config('adminzone.path') . '/' .  $this->slug();
    }
}
