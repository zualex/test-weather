<?php

declare(strict_types=1);

namespace Weather\Storage\Driver\Local;

use Weather\Storage\Driver\DriverInterface;

class LocalDriver implements DriverInterface
{
    public function setContentAsArray(array $content): DriverInterface
    {
        return $this;
    }

    public function setContentAsString(string $content): DriverInterface
    {
        return $this;
    }

    public function convertContentTo(string $type): DriverInterface
    {
        return $this;
    }

    public function save(string $filePath): bool
    {
        return false;
    }
}