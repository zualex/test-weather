<?php

declare(strict_types=1);

namespace Weather\ArrayConverter\Component;

use Weather\ArrayConverter\ComponentInterface;

class ArrayToJson implements ComponentInterface
{
    /**
     * @var array
     */
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * {@inheritDoc}
     */
    public function convert(): string
    {
        return json_encode($this->array);
    }
}