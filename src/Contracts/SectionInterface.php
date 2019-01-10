<?php


/**
 * Trait Section
 */

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Incraigulous\AdminZone\Contracts\HasFields;
use Incraigulous\AdminZone\Elements;

interface SectionInterface extends HasElements, ItemInterface, ElementInterface
{
    public static function create(string $label = null): SectionInterface;
}
