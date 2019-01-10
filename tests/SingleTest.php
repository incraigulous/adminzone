<?php
/**
 * SingleTest.php
 */
namespace Incraigulous\AdminZone\Tests;
use Incraigulous\AdminZone\Singles\ExampleSingle;
use Incraigulous\Objection\Collection;
use PHPUnit\Framework\TestCase;

class SingleTest extends TestCase
{
    public function testType()
    {
        $single = new ExampleSingle();
        $this->assertEquals('single', $single->type());
    }

    public function testToObject()
    {
        $single = new ExampleSingle();
        $this->assertInstanceOf(Collection::class, $single->toObject()->data->content);
    }
}
