<?php


/**
 * Trait Resolver
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function paginate($perPage = 15): LengthAwarePaginator;
    public function delete($id);
    public function update($id, array $input);
    public function create(array $input);
    public function setFilters(array $filters);
    public function isRevisionable(): bool;
    public function revisions($id): Collection;
    public function isTranslatable(): bool;
}
