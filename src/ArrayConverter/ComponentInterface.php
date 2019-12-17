<?php

declare(strict_types=1);

namespace Weather\ArrayConverter;

interface ComponentInterface
{
    /**
     * Convert array
     *
     * @param array $array
     * @return string
     */
    public function convert(array $array): string;
}