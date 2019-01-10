<?php
/**
 * AdminZoneTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\MenuItems\MenuItem;
use Incraigulous\AdminZone\Resources\ExampleResource;
use Incraigulous\AdminZone\Singles\ExampleSingle;

class RegisterTest extends TestCase
{
    public function testRegisterStrings()
    {
        AdminZone::register(ExampleResource::class);
        AdminZone::register(ExampleSingle::class);
        AdminZone::register(MenuItem::class);
        $this->assertEquals(AdminZone::getItems()->count(), 3);
        AdminZone::getItems()->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
        });
        AdminZone::reset();
    }

    public function testRegisterClasses()
    {
        AdminZone::register(new ExampleResource());
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
            ExampleResource::class,
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
