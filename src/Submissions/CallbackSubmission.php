<?php

namespace Incraigulous\AdminZone\Submissions;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\RepositoryInterface;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Elements;

/**
 * Class CallbackSubmission
 */
class CallbackSubmission extends Submission
{
    public $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function submit(Request $request, RepositoryInterface $repository)
    {
        $callback = $this->callback;
        return $callback($request, $repository);
    }
}
