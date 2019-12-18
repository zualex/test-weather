<?php

declare(strict_types=1);

namespace Weather\ArraySorter;

class ArraySorter implements ArraySorterInterface
{
    /**
     * {@inheritDoc}
     *
     * Example:
     * $array = ['b' => 1, 'c' => 1, 'a' => 1];
     * $direction = ['a', 'b', 'c'];
     * ...
     *  (new ArraySorter)->sort($array, $direction) // ['a' => 1, 'b' => 1, 'c' => 1];
     */
    public function sort(array $array, array $arrayDirection): array
    {
        $result = $array;

        if (count($array) && count($arrayDirection)) {
            $result = array_merge(array_flip($arrayDirection), $array);
        }

        return $result;
    }
}