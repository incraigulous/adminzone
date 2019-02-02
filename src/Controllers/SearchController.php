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
        $query = $request->get('q');
        $filters = $request->has('filters') ? $request->get('filters') : [];
        if (!$query) {
            throw new RequestException('Please complete the search field.');
        }
        $results = ResourcesRepository::search($query, $filters);
        return view('adminzone::search.index', compact('query', 'results'));
    }
}
