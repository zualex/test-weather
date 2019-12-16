<?php
namespace Weather\Storage;

use Weather\Storage\Exception\InvalidDriver;

class StorageFactory
{
    public function create(string $driver)
    {
        if ($driver == 'local') {
            return new OpenWeatherMap();
        }

        throw new InvalidDriver(InvalidDriver::MESSAGE_NOT_FOUND);
    }
}