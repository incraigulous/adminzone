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
            $field->handleSubmission($request, $payload);
        });
        $id = $request->route('id');

        if ($id) {
            return $repository->update($id, $payload);
        } else {
            return $repository->create($payload);
        }
    }
}
