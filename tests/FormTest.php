<?php

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Validation\Validator;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\TextField;
use Incraigulous\AdminZone\Forms\ExampleForm;
use Incraigulous\AdminZone\Forms\Form;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\AdminZone\Submissions\CallbackSubmission;

class FormTest extends TestCase
{
    public function testGetType()
    {
        $form = new ExampleForm();
        $this->assertEquals('form', $form->type());
    }

    public function testHasRules()
    {
        $rules = ['name' => 'required'];
        $form = new ExampleForm();
        $this->assertArrayHasKey('first_name', $form->rules());
    }

    public function testLabel()
    {
        $form = new ExampleForm();
        $this->assertEquals('Example Form', $form->label());
    }

    public function testToArray()
    {
        $label = 'Your Name';

        $form = new ExampleForm();

        $array = $form->toArray();

        $this->assertEquals('form', $array['type']);
        $this->assertEquals('example-form', $array['slug']);
        $this->assertEquals('First Name', $array['main']['elements'][0]['label']);
    }

    public function testToJson()
    {
        $form = new ExampleForm();

        $json = $form->toJson();

        $this->assertJsonValueEquals($json, '$.type', 'form');
        $this->assertJsonValueEquals($json, '$.main.elements[0][label]', 'First Name');
        $this->assertJsonValueEquals($json, '$.main.elements[1][name]', 'last_name');
        $this->assertJsonValueEquals($json, '$.label', 'Example Form');
    }
}
