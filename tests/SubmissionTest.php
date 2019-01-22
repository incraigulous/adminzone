<?php
/**
 * SubmissionTest.php
 */
namespace Incraigulous\AdminZone\Tests;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Repositories\ModelRepository;
use Incraigulous\AdminZone\Submissions\Submission;
use Mockery;

class SubmissionTest extends TestCase
{

    public function testCreate()
    {
        $input = ['key' => 'value'];
        $request = new Request(['input' => $input]);
        $repository = Mockery::mock(ModelRepository::class);
        $repository->shouldReceive('create')->with($input);
        $submission = new Submission();
        $submission->submit($request, $repository);
    }

    public function testUpdate()
    {
        $id = 1;
        $input = ['key' => 'value', 'id' => $id];
        $request = new Request(['input' => $input]);
        $repository = Mockery::mock(ModelRepository::class);
        $repository->shouldReceive('update')->with($id, $input);
        $submission = new Submission();
        $submission->submit($request, $repository);
    }
}
