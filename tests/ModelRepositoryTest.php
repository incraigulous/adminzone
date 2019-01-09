<?php
/**
 * ModelRepositoryTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Filters\ExampleModelFilter;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Tests\Mocks\Model;
use PHPUnit\Framework\TestCase;

class ModelRepositoryTest extends TestCase
{

    public function testGetModel()
    {
        $repository = new ModelRepository(new Model());
        $this->assertInstanceOf(Model::class, $repository->getModel());
    }

    public function testUpdate()
    {
        $repository = new ModelRepository(new Model());
        $repository->update(3, new Request(['input' => []]));
        $model = $repository->getModel();
        $this->assertTrue($model->wasRecentlyCreated);
    }

    public function testFind()
    {
        $repository = new ModelRepository(new Model());
        $model = $repository->find(3);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Model::class, $model);
    }

    public function testAll()
    {
        $repository = new ModelRepository(new Model());
        $collection = $repository->all();
        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testPaginated()
    {
        $repository = new ModelRepository(new Model());
        $collection = $repository->paginated();
        $this->assertInstanceOf(Paginator::class, $collection);
    }
}
