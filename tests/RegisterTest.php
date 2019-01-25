<?php
/**
 * AdminZoneTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\MenuItems\MenuItem;
use Incraigulous\AdminZone\Resources\User;
use Incraigulous\AdminZone\Singles\ExampleSingle;

class RegisterTest extends TestCase
{
    public function testRegisterStrings()
    {
        AdminZone::register(User::class);
        AdminZone::register(ExampleSingle::class);
        AdminZone::register(MenuItem::class);
        $this->assertEquals(3, AdminZone::getItems()->count());
        AdminZone::getItems()->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
        });
        AdminZone::reset();
    }

    public function testRegisterClasses()
    {
        AdminZone::register(new User());
        AdminZone::register(new ExampleSingle());
        AdminZone::register(new MenuItem());
        $this->assertEquals(AdminZone::getItems()->count(), 3);
        AdminZone::getItems()->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
        });
        AdminZone::reset();
    }

    public function testRegisterArray()
    {
        AdminZone::register([
            User::class,
            ExampleSingle::class,
            MenuItem::class
        ]);
        $this->assertEquals(AdminZone::getItems()->count(), 3);
        AdminZone::getItems()->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
        });
        AdminZone::reset();
    }
}
