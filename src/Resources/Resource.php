<?php

namespace Incraigulous\AdminZone\Resources;


use Illuminate\Database\Eloquent\Model;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\ResourceInterface;
use Incraigulous\AdminZone\Contracts\FormInterface;
use Incraigulous\AdminZone\Exceptions\ResourceException;
use Incraigulous\AdminZone\MenuItems\MenuItem;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Item;

/**
 * Class Resource
 */
abstract class Resource extends MenuItem implements ResourceInterface
{
    public function type(): string
    {
        return 'resource';
    }

    public function columns(): array
    {
        return [
            'ID' => 'id',
            'Name' => 'name'
        ];
    }

    public function lenses(): array
    {
        return [];
    }

    public function form(): FormInterface
    {
        return null;
    }

    public function create(): FormInterface
    {
        return $this->form();
    }


    public function update(): FormInterface
    {
        return $this->form();
    }

    protected function model(): Model {
        return null;
    }

    protected function repository(): RepositoryInterface
    {
        if ($this->model()) {
            return new ModelRepository($this->model());
        }
        return null;
    }

    public function getRepository(): RepositoryInterface
    {
        return $this->repository()->setFilters($this->filters());
    }

    public function asArray(): array
    {
        return [
            'update' => $this->update(),
            'create' => $this->create(),
            'filters' => objection($this->filters())->toArray(),
            'columns' => $this->columns(),
            'lenses' => objection($this->lenses())->toArray(),
            'menu' => object($this->menu())->toArray()
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function menu(): array {
        return [
            'All ' . $this->collectionLabel() => $this,
            'New' . $this->label() => $this->create()
        ];
    }
}
