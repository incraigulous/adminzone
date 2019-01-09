<?php


/**
 * Trait Lenses
 */

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Support\Collection;

interface LensInterface extends ItemInterface
{
    public function data(RepositoryInterface $repository): Collection;
    public function columns(): array;
    public function filters(): array;
}
