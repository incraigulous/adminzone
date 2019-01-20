<?php

namespace Incraigulous\AdminZone\Controllers;

use Incraigulous\AdminZone\AdminZone;

/**
 * Class DashboardController
 */
class DashboardController extends Controller
{
    public function show() {
        return view ('adminzone::dashboard.show');
    }
}
