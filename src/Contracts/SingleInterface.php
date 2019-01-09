<?php


/**
 * Trait SingleInterface
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Support\Arrayable;

interface SingleInterface extends MenuItemInterface
{
    public function data(RepositoryInterface $repository): Arrayable;
}
