<?php


/**
 * Trait SingleInterface
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Support\Arrayable;

interface SingleInterface extends ItemInterface
{
    public function data(RepositoryInterface $repository): Arrayable;
}
