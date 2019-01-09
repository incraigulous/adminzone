<?php

namespace Incraigulous\AdminZone\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;

/**
 * Class Resolver
 */
class ModelRepository implements RepositoryInterface
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
        return $this->model->all();
    }

    public function paginated($perPage = 15): Paginator
    {
        return $this->model->paginated($perPage);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function update($id, Request $request)
    {
        $model = $this->find($id);
        $model->fill($request->input);
        return $model->save();
    }

    public function create(Request $request)
    {
        $model = $this->model->create($request->input);
        return $model->save();
    }
}
