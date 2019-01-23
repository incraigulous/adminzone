<?php
/**
 * ResourceTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\AdminZone;
use Incraigulous\AdminZone\Resources\ExampleResource;
use Incraigulous\AdminZone\Resources\Resource;
use Incraigulous\AdminZone\Singles\ExampleSingle;

class ResourceTest extends TestCase
{
    public function testRoutes()
    {
        $this->withoutExceptionHandling();
        AdminZone::register([
            ExampleResource::class,
            ExampleSingle::class
        ]);
        AdminZone::resources()->each(function($resource) {
            $this->actingAsUser()->get(url()->route($resource->route()))->assertResponseOk();
        });
    }
}
