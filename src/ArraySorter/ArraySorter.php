<?php
namespace Weather\ArraySorter;

class ArraySorter
{
    private $array;

    public function set(array $array): self
    {
        $this->array = $array;

        return $this;
    }

    public function sortBy(array $arrayDirection): self
    {
        return $this;
    }

    public function get(): array
    {
        return $this->array;
    }
}