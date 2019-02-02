<?php

namespace Incraigulous\AdminZone\Tests;


use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\Resources\ResourcesRepository;
use Incraigulous\AdminZone\Resources\SearchableUser;
use Incraigulous\AdminZone\Resources\User;

class SearchTest extends TestCase
{
    public function testLoad()
    {
        $this->actingAsUser()->get(route('adminzone::search', ['q' => 'test']))->assertResponseOk();
    }

    public function testItCanGetSearchableResources()
    {
        AdminZone::register([
            SearchableUser::class,
            User::class
        ]);
        $resources = ResourcesRepository::getSearchableResources();
        $this->assertEquals(1, $resources->count());
        $this->assertInstanceOf(SearchableUser::class, $resources->first());
    }

    public function testSearch()
    {
        factory(\Incraigulous\AdminZone\Models\User::class, 50)->create();
        $needle1 = factory(\Incraigulous\AdminZone\Models\User::class)->create([
            'name' => 'needle 1'
        ]);
        $needle2 = factory(\Incraigulous\AdminZone\Models\User::class)->create([
            'email' => 'needle 2'
        ]);

        AdminZone::register([
            SearchableUser::class,
            SearchableUser::class,
            SearchableUser::class,
            User::class
        ]);
        $results = ResourcesRepository::search('needle');
        $this->assertEquals(3, $results->count());
        $results->each(function($result) {
            $this->assertEquals(2, $result->results->count());
            $this->assertInstanceOf(SearchableUser::class, $result->resource);
        });
    }

}
