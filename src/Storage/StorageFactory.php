<?php

declare(strict_types=1);

namespace Weather\Storage;

use Weather\Storage\Driver\Local\LocalDriver;
use Weather\Storage\Exception\InvalidDriver;

class StorageFactory
{
    public function create(string $driver)
    {
        if ($driver == 'local') {
            return new LocalDriver();
        }

        throw new InvalidDriver(InvalidDriver::MESSAGE_NOT_FOUND);
    }
}