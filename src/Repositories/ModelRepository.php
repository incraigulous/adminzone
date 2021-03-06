<?php

namespace Incraigulous\AdminZone\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Models\Traits\Revisionable;
use Incraigulous\AdminZone\Models\Traits\Searchable;
use Incraigulous\AdminZone\Models\Traits\Translatable;

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
        $result = $this->model->find($id);
        if ($result instanceof Collection) {
            return $result->first();
        }
        return $result;
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
        foreach($input as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function create(array $input)
    {
        $model = $this->model->newInstance();
        foreach($input as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function getManyToMany($id, $name) {
        return $this->find($id)->$name()
            ->withPivot('order')->get()->sortBy(function($item) {
                return $item->pivot->order;
            });
    }

    public function isRevisionable(): bool
    {
        return array_key_exists(Revisionable::class, class_uses($this->model));
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
        return array_key_exists(Translatable::class, class_uses($this->model));
    }

    public function isSearchable(): bool
    {
        return array_key_exists(Searchable::class, class_uses($this->model));
    }

    public function search(string $query, $with = [], $perPage = 15): LengthAwarePaginator
    {
       $builder = $this->model->search($query);
       foreach($with as $relationship) {
           $builder->with($relationship);
       }
       return $builder->paginate($perPage);
    }

    public function availableFields(): Collection
    {
        return collect($this->model->availableFields());
    }

    public function sync($id, string $relationship, array $values)
    {
        return $this->model->find($id)->$relationship()->sync($values);
    }

    public function saveManyIds($id, string $relationship, array $ids)
    {
        return $this->saveMany($id, $relationship,
            $this->findMany($ids)->all()
        );
    }

    public function saveMany($id, string $relationship, array $models)
    {
        foreach($models as $i => $model) {
            $model->order = $i;
            $result = $this->model->find($id)->$relationship()->save($model);
        }
    }

    public function syncHasMany($id, string $relationship, array $ids)
    {
        $model = $this->find($id);

        $toDelete = $model->$relationship->filter(function($item) use ($ids) {
            return !in_array($item->id, $ids);
        });

        $result = $this->saveManyIds($id, $relationship, $ids);

        foreach($toDelete as $child) {
            $key = $model->$relationship()->getForeignKeyName();
            $child->$key = null;
            $child->save();
        }

        return $result;
    }

    public function getHasMany($id, $name) {
        return $this->find($id)->$name()->orderBy('order')->get();
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
