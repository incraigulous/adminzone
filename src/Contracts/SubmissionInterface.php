<?php


/**
 * Trait Submission
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Http\Request;
use Incraigulous\AdminZone\Elements;

interface SubmissionInterface
{
    public function submit(Elements $items, Request $request, RepositoryInterface $repository);
}
