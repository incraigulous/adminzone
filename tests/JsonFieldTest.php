<?php
/**
 * JsonFieldTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\JsonField;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Sections\Repeatable;
use PHPUnit\Framework\TestCase;

class JsonFieldTest extends TestCase
{

    public function testCollectionLabel()
    {
        $label = 'Content';
        $field = JsonField::create($label);
        $this->assertEquals($label, $field->toObject()->label);
    }

    public function testType()
    {
        $label = 'Content';
        $field = JsonField::create($label);
        $this->assertEquals('field', $field->toObject()->type);
    }

    public function testTypePlural()
    {
        $label = 'Content';
        $field = JsonField::create($label);
        $this->assertEquals('fields', $field->toObject()->typePlural);
    }

    public function testDefault()
    {
        $label = 'Content';
        $default = json_encode(['en' => ['cat' => 'dog'], 'fr' => ['le cat', 'le dog']]);
        $field = JsonField::create($label)->default($default);
        $this->assertEquals($default, $field->getDefault());
    }

    public function testGetSections()
    {
        $label = 'Content';
        $field = JsonField::create($label)
                ->field(TextField::create('name'))
                ->field(TextField::create('label'));

        $this->assertEquals(0, $field->getSections()->count());

        $field->section(Repeatable::create('Scores')->field(TextField::create('Score')));

        $this->assertEquals(1, $field->getSections()->count());

        $names = Repeatable::create('Names')->field(TextField::create('Name'));
        $field->section($names);

        $this->assertEquals(2, $field->getSections()->count());
        $this->assertEquals($names, $field->getSections()->last());
    }
}
