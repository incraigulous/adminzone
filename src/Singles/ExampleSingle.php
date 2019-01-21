<?php

namespace Incraigulous\AdminZone\Singles;


use Illuminate\Contracts\Support\Arrayable;
use Incraigulous\AdminZone\Models\User;
use Incraigulous\AdminZone\Repositories\ModelRepository;

/**
 * Class ExampleSingle
 */
class ExampleSingle extends Single
{
    public $repository;

    public function data(): Arrayable
    {
        $repository = new ModelRepository(new User());
        return objection(['content' => $repository->all()]);
    }

    public function view(): string {
        return 'singles.example';
    }
}
