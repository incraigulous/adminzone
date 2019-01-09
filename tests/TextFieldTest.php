<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\TextField;

class TextFieldTest extends TestCase
{

    public function testLabel()
    {
        $type = new TextField('Text Field');
        $this->assertEquals($type->label(), 'Text Field');
    }
}
