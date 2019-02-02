<?php
/**
 * ModelRepositoryTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Filters\ExampleModelFilter;
use Incraigulous\AdminZone\Models\Model;
use Incraigulous\AdminZone\Models\SearchableUser;
use Incraigulous\AdminZone\Models\TranslatableUser;
use Incraigulous\AdminZone\Models\User;
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
        $name = $this->faker->name;
        $repository = new ModelRepository(new User());
        $user = $repository->update(1, ['name' => $name]);
        $this->assertEquals($user->name, $name);
    }

    public function testFind()
    {
       $user = factory(User::class)->create();
       $repository = new ModelRepository(new User());
       $model = $repository->find($user->id);
       $this->assertEquals($user->id, $model->id);
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
        $collection = $repository->paginate();
        $this->assertInstanceOf(LengthAwarePaginator::class, $collection);
    }

    public function testIsTranslatable()
    {
        $user = factory(User::class)->create();
        $translatableUser = new TranslatableUser();
        $repository = new ModelRepository($user);
        $translatableRepository = new ModelRepository($translatableUser);
        $this->assertTrue($translatableRepository->isTranslatable());
        $this->assertFalse($repository->isTranslatable());
    }

    public function testIsSearchable()
    {
        factory(User::class, 50)->create();
        $needle1 = factory(User::class)->create([
            'name' => 'needle 1'
        ]);
        $needle2 = factory(User::class)->create([
            'email' => 'needle 2'
        ]);

        $user = new SearchableUser();
        $repository = new ModelRepository($user);

        $this->assertTrue($repository->isSearchable());
        $results = $repository->search('needle');
        $found1 = $results->first(function($user) use ($needle1) {
            return $user->id === $needle1->id;
        });
        $found2 = $results->first(function($user) use ($needle2) {
            return $user->id === $needle2->id;
        });
        $this->assertNotNull($found1);
        $this->assertNotNull($found2);
    }
}
