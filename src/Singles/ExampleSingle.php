<?php

namespace Incraigulous\AdminZone\Singles;


use Illuminate\Contracts\Support\Arrayable;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Tests\Mocks\Model;

/**
 * Class ExampleSingle
 */
class ExampleSingle extends Single
{
    public $repository;

    public function data(): Arrayable
    {
        $repository = new ModelRepository(new Model());
        return objection(['content' => $repository->all()]);
    }

    public function view(): string {
        return 'singles.example';
    }
}
