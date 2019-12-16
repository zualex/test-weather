<?php
namespace Weather\ArraySorter;

class ArraySorter
{
    /**
     * @var array
     */
    private $array;

    /**
     * Set array
     *
     * @param array $array
     * @return ArraySorter
     */
    public function set(array $array): self
    {
        $this->array = $array;

        return $this;
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
        $arrayOrdered = array_merge(array_flip($arrayDirection), $array);

        $this->set($arrayOrdered);

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
}