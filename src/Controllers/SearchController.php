<?php

namespace Incraigulous\AdminZone\Controllers;


use Illuminate\Http\Request;
use Incraigulous\AdminZone\Exceptions\RequestException;
use Incraigulous\AdminZone\Resources\ResourcesRepository;

/**
 * Class SearchController
 */
class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->get('q') ? $request->get('q') : '';
        $filters = $request->has('filter') ? $request->get('filter') : [];
        $results = ResourcesRepository::search($query, $filters);
        return view('adminzone::search.index', compact('query', 'results'));
    }
}
