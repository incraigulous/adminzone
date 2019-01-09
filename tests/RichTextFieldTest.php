<?php
/**
 * TextFieldTest.php
 */

namespace  Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\RichTextField;

class RichTextFieldTest extends TestCase
{

    public function testGetLabel()
    {
        $type = new RichTextField('Rich Text Field');
        $this->assertEquals($type->label(), 'Rich Text Field');
    }
}
