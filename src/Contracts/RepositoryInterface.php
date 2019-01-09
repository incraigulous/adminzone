<?php


/**
 * Trait Resolver
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function paginated($perPage = 15): Paginator;
    public function delete($id);
    public function update($id, Request $request);
    public function create(Request $request);
    public function setFilters(array $filters);
}
