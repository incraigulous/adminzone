<?php


/**
 * Trait Revisionable
 */

namespace Incraigulous\AdminZone\Models\Contracts;

interface Revisionable
{
    /**
     * @return mixed
     */
    public function revisions();
}
