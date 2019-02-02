<?php

namespace Incraigulous\AdminZone\Submissions;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Exceptions\SubmissionException;
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
    public function submit(Request $request, RepositoryInterface $repository)
    {
        $input = array_only($request->all(), $repository->availableFields());
        $id = $request->route('id');

        if ($id) {
            return $repository->update($id, $input);
        } else {
            return $repository->create($input);
        }
    }
}
