<?php

namespace Incraigulous\AdminZone\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Models\Contracts\Revisionable;
use phpDocumentor\Reflection\Types\Parent_;
use Spatie\Translatable\HasTranslations;

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

    public function paginate($perPage = 15): LengthAwarePaginator
    {
        if (!$this->hasFilters()) {
            return $this->model->paginate($perPage);
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
        $model->save();
        return $model;
    }

    public function create(array $input)
    {
        $model = $this->model->create($input);
        return $model->save();
    }

    public function isRevisionable(): bool
    {
        return $this->model instanceof Revisionable;
    }

    public function revisions($id): Collection
    {
        if (!$this->isRevisionable()) {
            return parent::revisions();
        }

        return $this->find($id)->revisions()->get();
    }

    public function isTranslatable(): bool
    {
        return array_key_exists(HasTranslations::class, class_uses($this->model));
    }
}
