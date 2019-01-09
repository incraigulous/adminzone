<?php


/**
 * Trait ItemInterface
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface ElementInterface extends Arrayable, Jsonable
{
    public function setLabel(string $label): ElementInterface;
}
