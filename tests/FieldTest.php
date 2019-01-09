<?php
/**
 * FieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Faker\Provider\Text;
use Incraigulous\AdminZone\Exceptions\FieldTypeException;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\DataFactories\DataFactory;

class FieldTest extends TestCase
{
    public function testNew()
    {
        $label = 'First Name';
        $field = new TextField($label);

        $this->assertEquals($label, $field->label());
        $this->assertEquals('first_name', $field->getName());
    }

    public function testHandlesStringTypes()
    {
        $label = 'First Name';
        $field = TextField::create($label);

        $this->assertEquals($label, $field->label());
        $this->assertEquals('first_name', $field->getName());
    }

    public function testToJson()
    {
        $data = DataFactory::make('field:text');
        $field = TextField::create($data->label, $data->name);

        $field->default($data->default);

        $this->assertJsonValueEquals($field->toJson(), '$.name', $data->name);
        $this->assertJsonValueEquals($field->toJson(), '$.default', $data->default);
        $this->assertJsonValueEquals($field->toJson(), '$.label', $data->label);
    }

    public function testToArray()
    {
        $data = DataFactory::make('field:text');
        $field = TextField::create($data->label, $data->name);

        $field->default($data->default);

        $this->assertEquals($field->toArray()['name'], $data->name);
        $this->assertEquals($field->toArray()['default'], $data->default);
        $this->assertEquals($field->toArray()['label'], $data->label);
    }

    public function testBeforeSave()
    {
        $data = DataFactory::make('field:text');
        $field = TextField::create($data->label);


        $field->default($data->default);
        $field->beforeSave($this->callback);

        $beforeSave = $field->getBeforeSave();

        $this->assertInstanceOf(Field::class, $field);
        $this->assertTrue($beforeSave(true));
    }

    public function testCreate()
    {
        $field =TextField::create( 'First Name')->default('Craig');

        $this->assertEquals('first_name', $field->getName());
        $this->assertEquals('Craig', $field->getDefault());
    }
}
