<?php

namespace Incraigulous\AdminZone\Submissions;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Exceptions\SubmissionException;

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
    public function submit(Request $request, RepositoryInterface $repository)
    {
        $input = $request->input;

        if (!$input) {
            throw new SubmissionException("There is no input");
        }

        if (isset($input['id'])) {
            $repository->update($input['id'], $input);
        } else {
            $repository->create($input);
        }
    }
}
