<?php

namespace Incraigulous\AdminZone\Controllers;

use Incraigulous\AdminZone\AdminZone;

/**
 * Class DashboardController
 */
class DashboardController extends Controller
{
    public function show() {
        $menu = AdminZone::getItems();

        return view ('adminzone::dashboard.show', compact('menu'));
    }
}
