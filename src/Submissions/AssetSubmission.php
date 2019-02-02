<?php

namespace Incraigulous\AdminZone\Submissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Exceptions\SubmissionException;

/**
 * Class Submission
 */
class AssetSubmission implements SubmissionInterface
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
        $id = $request->route('id');
        $payload = [];
        $payload['title'] = $request->get('title');

        if ($request->hasFile('file')) {
            $payload['file'] = $request->file('file')->store('assets', config('adminzone.filesystem'));
            $payload['filename'] = $request->file('file')->getClientOriginalName();
        }
        if ($request->has('filename')) {
            $payload['filename'] = $request->get('filename');
        }
        $payload['filesystem'] = config('adminzone.filesystem');

        if ($id) {
            return $repository->update($id, $payload);
        } else {
            return $repository->create($payload);
        }
    }
}
