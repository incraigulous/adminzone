<?php
namespace Incraigulous\AdminZone;

use Incraigulous\AdminZone\Contracts\MenuItemInterface;
use Incraigulous\Objection\Collection;
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

    static function getItems(): Collection
    {
        return objection(static::$items);
    }

    static function resources(): Collection
    {
        return static::getItems();
    }

    static function toObject()
    {
        return objection(static::getItems()->toArray());
    }

    static function reset()
    {
        static::$items = [];
    }

    static function helpers()
    {
        return new Helpers();
    }
}
