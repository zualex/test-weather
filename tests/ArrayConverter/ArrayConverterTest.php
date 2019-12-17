<?php

declare(strict_types=1);

namespace Tests\ArraySorter;

use PHPUnit\Framework\TestCase;
use Weather\ArrayConverter\ArrayConverter;
use Weather\ArrayConverter\Exception\InvalidType;

class ArrayConverterTest extends TestCase
{
    /**
     * @dataProvider providerJson
     *
     * @param $array
     * @param $result
     */
    public function testConvertToJson($array, $result): void
    {
        $this->assertSame($result, (new ArrayConverter)->convertToJson($array));
    }

    /**
     * @dataProvider providerXml
     *
     * @param $array
     * @param $result
     */
    public function testConvertToXml($array, $result): void
    {
        $this->assertSame($result, (new ArrayConverter)->convertToXml($array));
    }

    public function testNotFoundComponent(): void
    {
        $this->expectException(InvalidType::class);
        $this->expectExceptionMessage(InvalidType::MESSAGE_NOT_FOUND_TYPE);

        (new ArrayConverter)->convertTo('not_found', []);
    }

    public function providerJson(): array
    {
        return [
            [
                ['a' => 1, 'b' => 1, 'c' => 1],
                '{"a":1,"b":1,"c":1}',
            ],
            [
                [],
                '[]',
            ],
        ];
    }

    public function providerXml(): array
    {
        return [
            [
                ['a' => 1, 'b' => 1, 'c' => 1],
                '<?xml version="1.0"?>' . PHP_EOL . '<root><a>1</a><b>1</b><c>1</c></root>' . PHP_EOL,
            ],
            [
                [],
                '<?xml version="1.0"?>' . PHP_EOL . '<root/>' . PHP_EOL,
            ],
        ];
    }
}