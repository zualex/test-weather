<?php

declare(strict_types=1);

namespace Weather\ArraySorter;

interface ArraySorterInterface
{
    /**
     * Sort by another array
     *
     * @param array $array
     * @param array $arrayDirection
     * @return array
     */
    public function sort(array $array, array $arrayDirection): array;
}