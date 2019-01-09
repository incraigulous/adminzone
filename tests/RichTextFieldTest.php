<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\RichTextField;

class RichTextFieldTest extends TestCase
{

    public function testGetLabel()
    {
        $type = new RichTextField();
        $this->assertEquals($type->label(), 'Rich Text Field');
    }

    public function testToArray()
    {
        $type = new RichTextField();
        $this->assertEquals($type->toArray(), [
            'type' => 'field-type',
            'typePlural' => 'field-types',
            'label' => 'Rich Text Field',
            'collectionLabel' => 'Rich Text Fields',
            'slug' => 'rich-text-field',
            'view' => 'field-types.rich-text-field'
        ]);
    }
}
