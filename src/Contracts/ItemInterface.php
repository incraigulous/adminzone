<?php


/**
 * Trait ItemInterface
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface ItemInterface extends Arrayable, Jsonable, Objectable
{
    public function getView(): string;
    public function getSlug(): string;
    public function getType(): string;
    public function getTypePlural(): string;
    public function getLabel(): string;
    public function getRoute(): string;
    public function getPath(): string;
    public function getCollectionLabel(): string;
}
