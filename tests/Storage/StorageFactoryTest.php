<?php

declare(strict_types=1);

namespace tests\Storage;

use PHPUnit\Framework\TestCase;
use Weather\Storage\Driver\DriverInterface;
use Weather\Storage\Exception\InvalidDriver;
use Weather\Storage\StorageFactory;

class StorageFactoryTest extends TestCase
{
    public function testCreate()
    {
        $storageByConst = (new StorageFactory())->create(StorageFactory::DRIVER_LOCAL);
        $storageByCamelCaseDriver = (new StorageFactory())->create('LoCAl');

        $this->assertInstanceOf(DriverInterface::class, $storageByConst);
        $this->assertInstanceOf(DriverInterface::class, $storageByCamelCaseDriver);
    }

    public function testFailCreate()
    {
        $this->expectException(InvalidDriver::class);
        $this->expectExceptionMessage(InvalidDriver::MESSAGE_NOT_FOUND);

        (new StorageFactory())->create('not_found');
    }
}