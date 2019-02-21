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
class AssetSubmission extends Submission
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
        $id = $request->route('id');
        $payload = [];
        $payload['title'] = $request->get('title');

        if ($request->hasFile('file')) {
            $file =  $request->file('file');
            $disk = config('adminzone.filesystem');
            $path = 'uploads/' . sha1(time());
            $filename = $file->getClientOriginalName();
            $key = $path . '/' . $filename;
            $file->storeAs($path, $filename, config('adminzone.filesystem'));
            $payload['file'] = Storage::disk(config('adminzone.filesystem'))->url($key);
            $payload['filename'] = $file->getClientOriginalName();
            $payload['mime'] = $file->getMimeType();
        }

        if ($request->get('filename')) {
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
