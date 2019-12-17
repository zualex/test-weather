<?php

declare(strict_types=1);

namespace Weather\ArrayConverter\Component;

use Weather\ArrayConverter\ComponentInterface;
use \Spatie\ArrayToXml\ArrayToXml as SpatieArrayToXml;

class ArrayToXml implements ComponentInterface
{
    /**
     * {@inheritDoc}
     */
    public function convert(array $array): string
    {
        return SpatieArrayToXml::convert($array);
    }
}