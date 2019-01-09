<?php


/**
 * Trait ItemInterface
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface ItemInterface extends Arrayable, Jsonable, Objectable
{
    public function view(): string;
    public function slug(): string;
    public function type(): string;
    public function typePlural(): string;
    public function label(): string;
    public function collectionLabel(): string;
}
