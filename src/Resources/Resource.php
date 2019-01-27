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
    protected function type(): string
    {
        return 'resource';
    }

    public function columns(): array
    {
        return [
            'ID' => 'id',
            'Created' => function($model) {
                return $model->created_at->format('M d Y');
            },
            'Updated' => function($model) {
                return $model->updated_at->format('M d Y');
            }
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

    public function repository(): RepositoryInterface
    {
        return new ModelRepository($this->model());
    }

    public function getRepository(): RepositoryInterface
    {
        return $this->repository()->setFilters($this->filters());
    }

    public function asArray(): array
    {
        return [
            'isRevisionable' => ($this->repository()) ? $this->repository()->isRevisionable() : false,
            'isTranslatable' => ($this->repository()) ? $this->repository()->isTranslatable() : false
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array {
        return [
            'Edit' => 'id',
            'Delete' => function($model) {
                return $model->created_at->format('M d Y');
            },
            'Updated' => function($model) {
                return $model->updated_at->format('M d Y');
            }
        ];
    }

    public function createRoute()
    {
        return $this->getRoute() . ':create';
    }

    public function editRoute()
    {
        return $this->getRoute() . ':edit';
    }

    public function showRoute()
    {
        return $this->getRoute() . ':show';
    }


    public function getForm(): FormInterface
    {
        return $this->form();
    }

    public function getCreate(): FormInterface
    {
        return $this->create();
    }

    public function getUpdate(): FormInterface
    {
        return $this->update();
    }

    public function getFilters(): array
    {
        return $this->filters();
    }

    public function getColumns(): array
    {
        return $this->columns();
    }

    public function getLenses(): array
    {
        return $this->lenses();
    }

    public function getActions(): array
    {
        return $this->actions();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute();
    }

    public function getEditRoute(): string
    {
        return $this->editRoute();
    }

    public function getShowRoute(): string
    {
        return $this->showRoute();
    }
}
