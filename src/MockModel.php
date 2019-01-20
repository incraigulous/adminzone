<?php

namespace Incraigulous\AdminZone;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Base;
use Illuminate\Pagination\Paginator;

class MockModel extends Base
{
    public function find($id) {
        return new MockModel();
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

    public function where()
    {
        return $this;
    }

    public function newQuery()
    {
        return $this;
    }
}
