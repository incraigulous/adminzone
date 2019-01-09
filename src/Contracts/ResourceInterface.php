<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ResourceInterface extends ItemInterface
{
    public function getRepository(): RepositoryInterface;
    public function form(): FormInterface;
    public function create(): FormInterface;
    public function update(): FormInterface;
    public function filters(): array;
    public function columns(): array;
    public function lenses(): array;
}
