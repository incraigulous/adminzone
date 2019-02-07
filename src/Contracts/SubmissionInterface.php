<?php


/**
 * Trait Submission
 */

namespace Incraigulous\AdminZone\Contracts;


use Illuminate\Http\Request;
use Incraigulous\AdminZone\Elements;

interface SubmissionInterface
{
    public function preparePayload(Request $request, Elements $fields, RepositoryInterface $repository): array;
    public function submit(Request $request, Elements $fields, RepositoryInterface $repository);
    public function handleAfterSave(Request $request, Elements $fields, RepositoryInterface $repository, $entry): void;
}
