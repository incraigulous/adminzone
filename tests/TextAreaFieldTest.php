<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\TextAreaField;

class TextAreaFieldTest extends TestCase
{

    public function testLabel()
    {
        $type = new TextAreaField();
        $this->assertEquals($type->label(), 'Text Area Field');
    }
}
