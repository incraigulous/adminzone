<?php

namespace Incraigulous\AdminZone\Resources;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\ResourceInterface;
use Incraigulous\AdminZone\Contracts\FormInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\MenuItems\MenuItem;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Submissions\CallbackSubmission;

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
            'Label' => 'label',
            'Description' => 'description',
            'Created' => function($model) {
                return $model->created_at->format('M d Y');
            },
            'Updated' => function($model) {
                return $model->updated_at->format('M d Y');
            }
        ];
    }

    protected function fields(): array
    {
        return $this->repository()->availableFields()->reduce(function($carry, $field) {
            $carry[ucfirst(str_replace("_", " ", $field))] = $field;
            return $carry;
        }, []);
    }

    public function getFields(): array {
        return $this->fields();
    }

    public function lenses(): array
    {
        return [];
    }

    public function form()
    {
        return null;
    }

    protected function createForm()
    {
        return $this->form();
    }

    protected function editForm()
    {
        return $this->form();
    }

    protected function model() {
        return null;
    }

    protected function destroySubmission(): SubmissionInterface
    {
        return new CallbackSubmission(
            function(Request $request, Elements $fields, RepositoryInterface $repository) {
                $id = $request->route('id');
                return $repository->delete($id);
            }
        );
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
        return $this->getRoute() . '.create';
    }

    public function editRoute()
    {
        return $this->getRoute() . '.edit';
    }

    public function showRoute()
    {
        return $this->getRoute() . '.show';
    }

    public function storeRoute()
    {
        return $this->getRoute() . '.store';
    }

    public function updateRoute()
    {
        return $this->getRoute() . '.update';
    }

    public function destroyRoute()
    {
        return $this->getRoute() . '.destroy';
    }

    public function getForm(): FormInterface
    {
        return $this->form();
    }

    public function getCreateForm(): FormInterface
    {
        return $this->createForm();
    }

    public function getEditForm(): FormInterface
    {
        return $this->editForm();
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

    public function getUpdateRoute(): string
    {
        return $this->updateRoute();
    }

    public function getStoreRoute(): string
    {
        return $this->storeRoute();
    }

    public function getDestroyRoute(): string
    {
        return $this->destroyRoute();
    }

    public function isSearchable(): bool
    {
        return $this->repository()->isSearchable();
    }

    public function search($string): LengthAwarePaginator
    {
        return $this->repository()->search($string);
    }

    public function getDestroySubmission(): SubmissionInterface
    {
        return $this->destroySubmission();
    }
}
