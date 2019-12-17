<?php

declare(strict_types=1);

namespace Weather\ArrayConverter\Exception;

class InvalidType extends \Exception
{
    public const MESSAGE_NOT_FOUND_TYPE = 'Not found type converter';
}
