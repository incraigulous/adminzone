<?php

namespace Incraigulous\AdminZone\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;

/**
 * Class Resolver
 */
class ModelRepository extends Repository implements RepositoryInterface
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        if (!$this->hasFilters()) {
            return $this->model->all();
        }

        return $this->filterQuery(
            $this->model->newQuery()
        )->get();
    }

    public function paginated($perPage = 15): Paginator
    {
        if (!$this->hasFilters()) {
            return $this->model->paginated($perPage);
        }

        return $this->filterQuery(
            $this->model->newQuery()
        )->paginated($perPage);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function update($id, array $input)
    {
        $model = $this->find($id);
        $model->fill($input);
        return $model->save();
    }

    public function create(array $input)
    {
        $model = $this->model->create($input);
        return $model->save();
    }
}
