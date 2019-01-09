<?php
/**
 * CallbackSubmissionTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Fields\Types\TextField;
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
        $fields = new Elements([
            new TextField('First Name'),
            new TextField('Last Name'),
        ]);
        $repository = new ModelRepository(new Model);
        $submission = new CallbackSubmission(function($f, $r, $repo) use ($fields, $request) {
            $this->assertEquals($fields, $f);
            $this->assertEquals($request, $r);
            $this->assertEquals($repo, $repo);
        });
        $submission->submit($fields, $request, $repository);
    }

    public function testIsValid()
    {

    }

    public function test__construct()
    {
        $submission = new CallbackSubmission($this->callback);
        $this->assertEquals($this->callback, $submission->callback);
    }
}
