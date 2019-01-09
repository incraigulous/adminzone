<?php
/**
 * ItemsTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Sections\Section;
use PHPUnit\Framework\TestCase;

class ItemsTest extends TestCase
{

    public function testGetSections()
    {
        $items = new Elements([
            Section::create('1'),
            TextField::create('second'),
            Section::create('2')
        ]);

        $this->assertEquals(2, $items->getSections()->count());
        $items->getSections()->each(function($item) {
            $this->assertInstanceOf(Section::class, $item);
        });
    }

    public function testGetFields()
    {
        $items = new Elements([
            TextField::create('first'),
            Section::create('section'),
            TextField::create('second')
        ]);

        $this->assertEquals(2, $items->getFields()->count());
        $items->getFields()->each(function($item) {
            $this->assertInstanceOf(Field::class, $item);
        });
    }
}
