<?php

declare(strict_types=1);

namespace Weather\ArrayConverter;

interface ComponentInterface
{
    /**
     * Convert array
     *
     * @return string
     */
    public function convert(): string;
}