<?php
namespace Weather\Storage\Driver;

interface DriverInterface
{
    public function setContentAsArray(array $content): self;

    public function setContentAsString(string $content): self;

    public function convertContentTo(string $type): self;

    public function save(string $filePath): bool;
}