<?php

namespace Incraigulous\AdminZone\Tests\Mocks;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Base;
use Illuminate\Pagination\Paginator;

class Model extends Base
{
    public function find($id) {
        return new Model();
    }

    public static function all($columns = []) {
        return new Collection([]);
    }

    public function fill(array $options = [])
    {
        $this->exists = true;
        $this->wasRecentlyCreated = true;
    }

    public function create(array $options = [])
    {
        $this->exists = true;
        $this->wasRecentlyCreated = true;
    }

    public function paginated($num)
    {
        $this->exists = true;
        $this->wasRecentlyCreated = true;
        return new Paginator([], []);
    }

    public function save(array $options = [])
    {
        $this->exists = true;
        $this->wasRecentlyCreated = true;
    }

    public function delete()
    {
        $this->exists = false;
        $this->wasRecentlyCreated = false;
    }
}
