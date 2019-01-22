<?php

namespace Incraigulous\AdminZone\Tests;


use Incraigulous\AdminZone\Models\Revision;
use Incraigulous\AdminZone\Models\User;

/**
 * Class RevisionsTest
 */
class RevisionsTest extends TestCase
{
    public function testSave() {
        $data = factory(Revision::class)->states('user')->make();
        $revision = Revision::create($data->toArray());
        $revision->save();
        $this->assertEquals($data['data']['name'], $revision->data->name);
    }

    public function testUpdate() {
        $sentence = $this->faker->sentence;
        $revision = factory(Revision::class)->states('user')->create();
        $revision->message = $sentence;
        $revision = $revision->fill($revision->toArray());
        $revision->save();
        $this->assertEquals($sentence, $revision->message);
    }

    public function testStoresRevisions() {
        $name = $this->faker->name;
        $user = factory(User::class)->create();
        $user->name = $name;
        $user->save();
        $this->assertEquals($name, $user->revisions()->first()->data->name);
    }

    public function testRestoresRevisions() {
        $name = $this->faker->name;
        $name2 = $this->faker->name;
        $user = factory(User::class)->create();
        $user->name = $name;
        $user->save();
        $this->assertEquals($name, $user->revisions()->first()->data->name);
        $user->name = $name2;
        $user->save();
        $this->assertEquals($name2, $user->name);
        $user->revisions()->first()->restore();
        $user = $user->find($user->id);
        $this->assertEquals($name, $user->name);
    }
}
