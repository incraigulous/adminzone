<?php
/**
 * FieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Faker\Provider\Text;
use Incraigulous\AdminZone\Exceptions\FieldTypeException;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\TextField;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\DataFactories\DataFactory;

class FieldTest extends TestCase
{
    public function testNew()
    {
        $label = 'First Name';
        $field = new Field(
            new TextField(),
            $label
        );

        $this->assertEquals($label, $field->label());
        $this->assertEquals('first_name', $field->getName());
        $this->assertInstanceOf(TextField::class, $field->getFieldType());
    }

    public function testHandlesStringTypes()
    {
        $label = 'First Name';
        $field = new Field(
            TextField::class,
            $label
        );

        $this->assertEquals($label, $field->label());
        $this->assertEquals('first_name', $field->getName());
        $this->assertInstanceOf(TextField::class, $field->getFieldType());
    }

    public function testFailsOnWrongClass()
    {
        $this->expectException(FieldTypeException::class);

        $label = 'First Name';
        $field = new Field(
            FieldSet::class,
            $label
        );
    }

    public function testToJson()
    {
        $data = DataFactory::make('field:text');
        $field = new Field(
            TextField::class,
            $data->label,
            $data->name
        );

        $field->default($data->default);

        $this->assertJsonValueEquals($field->toJson(), '$.name', $data->name);
        $this->assertJsonValueEquals($field->toJson(), '$.fieldType[slug]', 'text-field');
        $this->assertJsonValueEquals($field->toJson(), '$.default', $data->default);
        $this->assertJsonValueEquals($field->toJson(), '$.label', $data->label);
    }

    public function testToArray()
    {
        $data = DataFactory::make('field:text');
        $field = new Field(
            TextField::class,
            $data->label,
            $data->name
        );

        $field->default($data->default);

        $this->assertEquals($field->toArray()['name'], $data->name);
        $this->assertEquals($field->toArray()['fieldType']['label'], $data->type->name);
        $this->assertEquals($field->toArray()['default'], $data->default);
        $this->assertEquals($field->toArray()['label'], $data->label);
    }

    public function testBeforeSave()
    {
        $data = DataFactory::make('field:text');
        $field = new Field(
            TextField::class,
            $data->label,
            $data->name
        );

        $field->default($data->default);
        $field->beforeSave($this->callback);

        $beforeSave = $field->getBeforeSave();

        $this->assertInstanceOf(Field::class, $field);
        $this->assertTrue($beforeSave(true));
    }

    public function testCreate()
    {
        $field = Field::create(TextField::class, 'First Name')->default('Craig');

        $this->assertEquals('first_name', $field->getName());
        $this->assertEquals('Craig', $field->getDefault());
    }
}
