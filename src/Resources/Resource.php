<?php

namespace Incraigulous\AdminZone\Resources;


use Illuminate\Database\Eloquent\Model;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\ResourceInterface;
use Incraigulous\AdminZone\Contracts\FormInterface;
use Incraigulous\AdminZone\Repositories\ModelRepository;

/**
 * Class Resource
 */
abstract class Resource extends Item implements ResourceInterface
{
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

    public function model(): Model {
        return null;
    }

    public function repository(): RepositoryInterface
    {
        return new ModelRepository($this->model());
    }

    public function asArray(): array
    {
        return [
            'update' => $this->update(),
            'create' => $this->create()
        ];
    }
}
