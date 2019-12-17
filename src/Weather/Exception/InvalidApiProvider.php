<?php

declare(strict_types=1);

namespace Weather\Weather\Exception;

class InvalidApiProvider extends \Exception
{
    public const MESSAGE_NOT_FOUND_TYPE = 'Not found API provider';
}
