<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ResourceInterface extends MenuItemInterface
{
    public function getRepository(): RepositoryInterface;
    public function getForm(): FormInterface;
    public function getCreate(): FormInterface;
    public function getUpdate(): FormInterface;
    public function getFilters(): array;
    public function getColumns(): array;
    public function getLenses(): array;
    public function getActions(): array;
    public function getShowRoute(): string;
    public function getEditRoute(): string;
    public function getCreateRoute(): string;
}
