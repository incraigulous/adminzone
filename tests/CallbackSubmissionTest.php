<?php
/**
 * CallbackSubmissionTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Fields\Fields;
use Illuminate\Foundation\Auth\User;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Submissions\CallbackSubmission;

class CallbackSubmissionTest extends TestCase
{
    public function testSubmit()
    {
        $request = new Request();
        $repository = new ModelRepository(new User());
        $submission = new CallbackSubmission(function($r, $repo) use ($request, $repository) {
            $this->assertEquals($request, $r);
            $this->assertEquals($repo, $repo);
        });
        $submission->submit($request, $repository);
    }
}
