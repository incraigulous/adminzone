<?php
namespace Incraigulous\AdminZone;

use Incraigulous\AdminZone\Contracts\MenuItemInterface;
use Incraigulous\Objection\ObjectionFactory;
/**
 * Class AdminZone
 */
class AdminZone
{
    public static $items = [];

    static function register($itemOrItems)
    {
        if (is_string($itemOrItems)) {
            $itemOrItems = new $itemOrItems;
        }
        if (is_array($itemOrItems)) {
            static::registerArray($itemOrItems);
            return;
        }
        static::$items[] = $itemOrItems;
    }

    static protected function registerArray(array $items)
    {
        foreach ($items as $item) {
            static::register($item);
        }
    }

    static function getItems()
    {
        return ObjectionFactory::make(static::$items);
    }

    static function reset()
    {
        static::$items = [];
    }
}
