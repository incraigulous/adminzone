<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\TextField;

class TextFieldTest extends TestCase
{

    public function testLabel()
    {
        $type = new TextField();
        $this->assertEquals($type->label(), 'Text Field');
    }
}
