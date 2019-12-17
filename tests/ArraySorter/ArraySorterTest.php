<?php

declare(strict_types=1);

namespace Tests\ArraySorter;

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
    public function testSort($array, $direction, $result): void
    {
        $this->assertSame($result, (new ArraySorter)->sort($array, $direction));
    }

    /**
     * @dataProvider provider
     *
     * @param $array
     * @param $direction
     * @param $result
     */
    public function testSortBy($array, $direction, $result): void
    {
        $this->assertSame($result, (new ArraySorter)->sort($array, $direction));
    }

    public function testSortWithEmpty(): void
    {
        $this->assertSame([], (new ArraySorter)->sort([], ['a', 'b', 'c']));
        $this->assertSame(['a', 'b', 'c'], (new ArraySorter)->sort(['a', 'b', 'c'], []));
    }

    public function provider(): array
    {
        return [
            [
                ['b' => 1, 'c' => 1, 'a' => 1],
                ['a', 'b', 'c'],
                ['a' => 1, 'b' => 1, 'c' => 1],
            ],
            [
                ['a' => '1', 'c' => '1', 'd' => '1', 'b' => '1'],
                ['a', 'b', 'd', 'c'],
                ['a' => '1', 'b' => '1', 'd' => '1', 'c' => '1'],
            ]
        ];
    }
}