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
    public function preparePayload(Request $request, Elements $fields, RepositoryInterface $repository): array
    {
        $payload = [];

        $fields->each(function(Field $field) use ($request, &$payload) {
            $field->prepareSubmission($request, $payload);
        });

        return $payload;
    }

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
        $payload = $this->preparePayload($request, $fields, $repository);

        $id = $request->route('id');

        if ($id) {
            $entry = $repository->update($id, $payload);
        } else {
            $entry = $repository->create($payload);
        }

        $this->handleAfterSave($request, $fields, $repository, $entry);

        return $entry;
    }

    /**
     * @param Request             $request
     * @param Elements            $fields
     * @param RepositoryInterface $repository
     * @param                     $entry
     */
    public function handleAfterSave(Request $request, Elements $fields, RepositoryInterface $repository, $entry): void
    {
        $fields->each(function (Field $field) use ($request, $entry, $repository) {
            $field->afterSubmission($request, $entry, $repository);
        });
    }
}
