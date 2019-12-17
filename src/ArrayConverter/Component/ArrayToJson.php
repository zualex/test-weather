<?php

declare(strict_types=1);

namespace Weather\ArrayConverter\Component;

use Weather\ArrayConverter\ComponentInterface;

class ArrayToJson implements ComponentInterface
{
    /**
     * {@inheritDoc}
     */
    public function convert(array $array): string
    {
        return json_encode($array);
    }
}