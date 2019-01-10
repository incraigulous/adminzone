<?php
/**
 * CallbackSubmissionTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Submissions\CallbackSubmission;
use Incraigulous\AdminZone\Tests\Mocks\Model;
use JsonSchema\Exception\ValidationException;

class CallbackSubmissionTest extends TestCase
{
    public function testSubmit()
    {
        $request = new Request();
        $repository = new ModelRepository(new Model);
        $submission = new CallbackSubmission(function($r, $repo) use ($request, $repository) {
            $this->assertEquals($request, $r);
            $this->assertEquals($repo, $repo);
        });
        $submission->submit($request, $repository);
    }
}
