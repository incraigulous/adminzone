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
        $this->assertArrayHasKey('name', $form->rules());
    }

    public function testLabel()
    {
        $form = new UserEditForm();
        $this->assertEquals('User Edit Form', $form->getLabel());
    }

    public function testToArray()
    {
        $label = 'Your Name';

        $form = new UserEditForm();

        $array = $form->toArray();

        $this->assertEquals('form', $array['type']);
        $this->assertEquals('user-edit-form', $array['slug']);
        $this->assertEquals('Name', $array['main']['elements'][0]['label']);
    }

    public function testToJson()
    {
        $form = new UserEditForm();

        $json = $form->toJson();

        $this->assertJsonValueEquals($json, '$.type', 'form');
        $this->assertJsonValueEquals($json, '$.main.elements[0][label]', 'Name');
        $this->assertJsonValueEquals($json, '$.label', 'User Edit Form');
    }
}
