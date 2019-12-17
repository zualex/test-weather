<?php

declare(strict_types=1);

namespace Weather\ArrayConverter;

interface ArrayConverterInterface
{
    public const TYPE_JSON = 'json';
    public const TYPE_XML = 'xml';

    /**
     * Convert array to json
     *
     * @param array $array
     * @return string
     */
    public static function convertToJson(array $array): string;

    /**
     * Convert array to xml
     *
     * @param array $array
     * @return string
     */
    public static function convertToXml(array $array): string;
}