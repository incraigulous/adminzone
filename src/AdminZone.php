<?php
namespace Incraigulous\AdminZone;

use Incraigulous\AdminZone\Contracts\MenuItemInterface;

/**
 * Class AdminZone
 */
class AdminZone
{
    public static $items = [];

    static function register(MenuItemInterface $menuItem)
    {
        static::$items[] = $menuItem;
    }

    static function getItems()
    {
        return objection(static::$items);
    }
}
