<?php

namespace Incraigulous\AdminZone\Tests;


use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\Models\SearchableUser;
use Incraigulous\AdminZone\Models\User;

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    public function testItSearches()
    {
        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $user = new SearchableUser();
        factory(User::class, 50)->create();
        $needle1 = factory(User::class)->create([
            'name' => 'needle 1'
        ]);
        $needle2 = factory(User::class)->create([
            'email' => 'needle 2'
        ]);


        $results = $user->search('needle')->get();
        $found1 = $results->first(function($user) use ($needle1) {
            return $user->id === $needle1->id;
        });
        $found2 = $results->first(function($user) use ($needle2) {
            return $user->id === $needle2->id;
        });
        $this->assertNotNull($found1);
        $this->assertNotNull($found2);
    }

    public function testItLoadsEdit()
    {
        $this->withoutExceptionHandling();

        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $user = factory(User::class)->create();
        $resource = new \Incraigulous\AdminZone\Resources\User();
        $this->actingAsUser()->get(
            route($resource->getEditRoute(), [
                'slug' => $resource->getSlug(),
                'id' => $user->id]
            )
        )->assertResponseOk();
    }

    public function testEditSubmits()
    {
        $this->withoutExceptionHandling();
        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $email = $this->faker->email;
        $user = factory(User::class)->create();
        $payload = $user->toArray();
        $payload['email']  = $email;
        $payload['password_confirmation']  = $user->password;
        $resource = new \Incraigulous\AdminZone\Resources\User($user);
        $this->actingAsUser()->put(
            route($resource->getUpdateRoute(), [
                'slug' => $resource->getSlug(),
                'id' => $user->id
            ]),
            $payload
        )->assertResponseStatus(302);
        $new = User::find($user->id);
        $this->assertEquals($email, $new->email);
    }

    public function testItLoadsCreate()
    {
        $this->withoutExceptionHandling();

        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $resource = new \Incraigulous\AdminZone\Resources\User();
        $this->actingAsUser()->get(
            route($resource->getCreateRoute(), [
                    'slug' => $resource->getSlug()
                ]
            )
        )->assertResponseOk();
    }

    public function testCreateSubmits()
    {
        $this->withoutExceptionHandling();
        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $user = factory(User::class)->make();
        $payload = $user->toArray();
        $payload['password_confirmation']  = $user->password;
        unset($payload['id']);
        $resource = new \Incraigulous\AdminZone\Resources\User($user);
        $result = $this->actingAsUser()->post(
            route($resource->getStoreRoute(), [
                'slug' => $resource->getSlug(),
                'id' => $user->id
            ]),
            $payload
        );
        $new = User::find(\DB::getPdo()->lastInsertId());
        $result->assertRedirectedTo(route($resource->getEditRoute(), [
            'slug' => $resource->getSlug(),
            'id' => $new->id
        ]));
        $this->assertEquals($user->email, $new->email);
    }

    public function testShowLoads()
    {
        $this->withoutExceptionHandling();
        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $user = factory(User::class)->create();
        $resource = new \Incraigulous\AdminZone\Resources\User();
        $this->actingAsUser()->get(
            route($resource->getShowRoute(), [
                'slug' => $resource->getSlug(),
                'id' => $user->id
            ])
        )->assertResponseOk();
    }

    public function testDeleteSubmits()
    {
        $this->withoutExceptionHandling();
        AdminZone::register(\Incraigulous\AdminZone\Resources\User::class);
        $user = factory(User::class)->create();
        $resource = new \Incraigulous\AdminZone\Resources\User();
        $result = $this->actingAsUser()->delete(
            route($resource->getDestroyRoute(), [
                'slug' => $resource->getSlug(),
                'id' => $user->id
            ])
        );
        $new = User::find($user->id);
        $result->assertRedirectedTo(route($resource->getRoute(), [
            'slug' => $resource->getSlug()
        ]));
        $this->assertNull($new);
    }

}
