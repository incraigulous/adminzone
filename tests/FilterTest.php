<?php
/**
 * FilterTest.php
 */

namespace Incraigulous\AdminZone\Tests;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Incraigulous\AdminZone\Filters\ExampleModelFilter;
use Incraigulous\AdminZone\Filters\ExampleQueryStringFilter;
use Incraigulous\AdminZone\Filters\Filter;
use Mockery as m;
use function BenTools\QueryString\query_string;

class FilterTest extends TestCase
{
    public function testModelFilter()
    {
        $filter = new ExampleModelFilter();
        $value = $this->faker->randomElement($filter->options());
        $builder = m::mock(Builder::class);
        $builder->shouldReceive('where')->with('isActive', $value)->andReturnSelf();
        $query = $filter->apply(new Request([], []), $builder, $value);
        $this->assertInstanceOf(Builder::class, $query);
    }

    public function testQueryStringFilter()
    {
        $filter = new ExampleQueryStringFilter();
        $value = $this->faker->randomElement($filter->options());
        $query = $filter->apply(new Request([], []), query_string(''), $value);
        $this->assertEquals('isActive=' . (int) $value, (string) $query);
    }
}
