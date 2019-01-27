<?php

namespace Incraigulous\AdminZone\Controllers;


/**
 * Class SearchController
 */
class SearchController extends Controller
{
    public function index() {
        return view('adminzone::search.index');
    }
}
