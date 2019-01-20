<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ResourceInterface extends MenuItemInterface
{
    public function getRepository(): RepositoryInterface;
    public function form();
    public function create();
    public function update();
    public function filters(): array;
    public function columns(): array;
    public function lenses(): array;
    public function menu(): array;
}
