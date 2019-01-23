<?php

namespace Incraigulous\AdminZone\Tests;


class DashboardTest extends TestCase
{
    public function testLoad()
    {
        $this->actingAsUser()->get(config('adminzone.path'))->assertResponseOk();
    }
}
