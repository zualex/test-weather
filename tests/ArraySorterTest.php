<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use Weather\ArraySorter\ArraySorter;

class ArraySorterTest extends TestCase
{
    /**
     * @dataProvider provider
     *
     * @param $array
     * @param $direction
     * @param $result
     */
    public function testSortBy($array, $direction, $result)
    {
        $arraySorter = new ArraySorter();
        $arraySorter->set($array);
        $arraySorter->sortBy($direction);

        $this->assertTrue($result === $arraySorter->get());
    }

    public function provider()
    {
        return [
            [
                ['a' => '1', 'c' => '1', 'd' => '1', 'b' => '1'],
                ['a', 'b', 'd', 'c'],
                ['a' => '1', 'b' => '1', 'd' => '1', 'c' => '1'],
            ]
        ];
    }
}