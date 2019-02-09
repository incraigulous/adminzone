<?php

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Sections\FieldSet;

class FieldSetTest extends TestCase
{
    public function testGetType()
    {
        $fieldset = new FieldSet();
        $this->assertEquals('section', $fieldset->type());
    }

    public function testLabel()
    {
        $label = 'Your Name';
        $fieldset = new FieldSet();
        $fieldset->setLabel('Your Name');
        $this->assertEquals($label, $fieldset->getLabel());
    }

    public function testToArray()
    {
        $label = 'Your Name';
        $fieldset = FieldSet::create()
            ->setLabel($label)
            ->field(TextField::create('First Name'))
            ->field(TextField::create('Last Name'));

        $array = $fieldset->toArray();


        $this->assertEquals('section', $array['type']);
        $this->assertEquals('Your Name', $array['label']);
        $this->assertEquals('First Name', $array['elements'][0]['label']);
    }

    public function testToJson()
    {
        $label = 'Your Name';
        $fieldset = FieldSet::create()
            ->setLabel($label)
            ->field(TextField::create('First Name'))
            ->field(TextField::create('Last Name'));

        $json = $fieldset->toJson();

        $this->assertJsonValueEquals($json, '$.type', 'section');
        $this->assertJsonValueEquals($json, '$.slug', 'field-set');
        $this->assertJsonValueEquals($json, '$.elements[0][label]', 'First Name');
        $this->assertJsonValueEquals($json, '$.elements[1][name]', 'last_name');
        $this->assertJsonValueEquals($json, '$.label', $label);
    }

    public function testField()
    {
        $fieldset = FieldSet::create()
            ->field(TextField::create('First Name'))
            ->field(TextField::create('Last Name'));

        $this->assertEquals('first_name', $fieldset->getFields()->first()->getName());
    }
}
