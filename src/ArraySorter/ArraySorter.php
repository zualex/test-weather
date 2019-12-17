<?php

declare(strict_types=1);

namespace Weather\ArraySorter;

class ArraySorter
{
    /**
     * @var array
     */
    private $array;

    public function __construct(array $array)
    {
        $this->setArray($array);
    }

    /**
     * {@inheritDoc}
     */
    public static function sort(array $array, array $arrayDirection): array
    {
        $sorter = new static($array);
        $sorter->sortBy($arrayDirection);

        return $sorter->get();
    }

    /**
     * Sort by another array
     *
     * Example:
     * $array = ['b' => 1, 'c' => 1, 'a' => 1];
     * $direction = ['a', 'b', 'c'];
     * ...
     *  $arraySorter->sortBy($direction)->get() // ['a' => 1, 'b' => 1, 'c' => 1];
     *
     * @param array $arrayDirection
     * @return ArraySorter
     */
    public function sortBy(array $arrayDirection): self
    {
        $array = $this->array;
        if (count($array) && count($arrayDirection)) {
            $arrayOrdered = array_merge(array_flip($arrayDirection), $array);
            $this->setArray($arrayOrdered);
        }

        return $this;
    }

    /**
     * Get array
     *
     * @return array
     */
    public function get(): array
    {
        return $this->array;
    }

    /**
     * Set array
     *
     * @param array $array
     * @return ArraySorter
     */
    private function setArray(array $array): self
    {
        $this->array = $array;

        return $this;
    }
}