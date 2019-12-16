<?php
namespace Weather\Storage\Exception;

class InvalidDriver extends \Exception
{
    const MESSAGE_NOT_FOUND = 'Not found storage provider';
}
