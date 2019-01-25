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
            'Name' => 'name',
            'email' => 'email'
        ];
    }

    public function lenses(): array
    {
        return [];
    }

    public function form()
    {
        return null;
    }

    public function create()
    {
        return $this->form();
    }


    public function update()
    {
        return $this->form();
    }

    protected function model() {
        return null;
    }

    protected function repository()
    {
        if ($this->model()) {
            return new ModelRepository($this->model());
        }
        return null;
    }

    public function getRepository()
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
            'menu' => objection($this->menu())->toArray(),
            'isRevisionable' => ($this->repository()) ? $this->repository()->isRevisionable() : false,
            'isTranslatable' => ($this->repository()) ? $this->repository()->isTranslatable() : false,
            'repository' => $this->getRepository()
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function menu(): array {
        return [
            'All ' . $this->collectionLabel() => $this->slug(),
            'New' . $this->label() => $this->create()
        ];
    }
}
