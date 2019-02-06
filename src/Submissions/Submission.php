<?php

namespace Incraigulous\AdminZone\Submissions;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\ElementInterface;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Exceptions\SubmissionException;
use Incraigulous\AdminZone\Fields\Field;
use PhpParser\Node\Stmt\Return_;

/**
 * Class Submission
 */
class Submission implements SubmissionInterface
{
    /**
     * @param Form    $form
     * @param Request $request
     *
     * @return bool
     * @throws SubmissionException
     * @throws \Throwable
     */
    public function submit(Request $request, Elements $fields, RepositoryInterface $repository)
    {
        $payload = [];
        $fields->each(function(Field $field) use ($request, &$payload) {
            $field->prepareSubmission($request, $payload);
        });
        $id = $request->route('id');

        if ($id) {
            $entry = $repository->update($id, $payload);
        } else {
            $entry = $repository->create($payload);
        }

        $fields->each(function(Field $field) use ($request, $entry, $repository) {
            $field->afterSubmission($request, $entry, $repository);
        });

        return $entry;
    }
}
