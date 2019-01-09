<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\TextAreaField;

class TextAreaFieldTest extends TestCase
{

    public function testLabel()
    {
        $type = new TextAreaField('Text Area Field');
        $this->assertEquals($type->label(), 'Text Area Field');
    }
}
