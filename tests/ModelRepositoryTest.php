<?php
/**
 * ModelRepositoryTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Filters\ExampleModelFilter;
use Illuminate\Foundation\Auth\User;
use Incraigulous\AdminZone\Repositories\ModelRepository;

class ModelRepositoryTest extends TestCase
{

    public function testGetModel()
    {
        $repository = new ModelRepository(new User());
        $this->assertInstanceOf(User::class, $repository->getModel());
    }

    public function testUpdate()
    {
        $repository = new ModelRepository(new User());
        $repository->update(3, []);
        $model = $repository->getModel();
        $this->assertTrue($model->wasRecentlyCreated);
    }

    public function testFind()
    {
        $repository = new ModelRepository(new User());
        $model = $repository->find(3);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Model::class, $model);
    }

    public function testAll()
    {
        $repository = new ModelRepository(new User());
        $collection = $repository->all();
        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testPaginated()
    {
        $repository = new ModelRepository(new User());
        $collection = $repository->paginated();
        $this->assertInstanceOf(Paginator::class, $collection);
    }
}
