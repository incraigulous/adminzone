<?php

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Validation\Validator;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\TextField;
use Incraigulous\AdminZone\Forms\UserEditForm;
use Incraigulous\AdminZone\Forms\Form;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\AdminZone\Submissions\CallbackSubmission;

class FormTest extends TestCase
{
    public function testGetType()
    {
        $form = new UserEditForm();
        $this->assertEquals('form', $form->type());
    }

    public function testHasRules()
    {
        $rules = ['name' => 'required'];
        $form = new UserEditForm();
        $this->assertArrayHasKey('first_name', $form->rules());
    }

    public function testLabel()
    {
        $form = new UserEditForm();
        $this->assertEquals('User Form', $form->getLabel());
    }

    public function testToArray()
    {
        $label = 'Your Name';

        $form = new UserEditForm();

        $array = $form->toArray();

        $this->assertEquals('form', $array['type']);
        $this->assertEquals('user-form', $array['slug']);
        $this->assertEquals('First Name', $array['main']['elements'][0]['label']);
    }

    public function testToJson()
    {
        $form = new UserEditForm();

        $json = $form->toJson();

        $this->assertJsonValueEquals($json, '$.type', 'form');
        $this->assertJsonValueEquals($json, '$.main.elements[0][label]', 'First Name');
        $this->assertJsonValueEquals($json, '$.main.elements[1][name]', 'last_name');
        $this->assertJsonValueEquals($json, '$.label', 'User Form');
    }
}
