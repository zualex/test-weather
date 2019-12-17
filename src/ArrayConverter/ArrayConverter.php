<?php

declare(strict_types=1);

namespace Weather\ArrayConverter;

use Weather\ArrayConverter\Component\ArrayToJson;
use Weather\ArrayConverter\Component\ArrayToXml;
use Weather\ArrayConverter\Exception\InvalidType;

class ArrayConverter
{
    public const TYPE_JSON = 'json';
    public const TYPE_XML = 'xml';

    /**
     * @var ComponentInterface
     */
    private $componentToJson;

    /**
     * @var ComponentInterface
     */
    private $componentToXml;

    /**
     * @param array $array
     * @param ComponentInterface|null $componentToJson
     * @param ComponentInterface|null $componentToXml
     */
    public function __construct(
        array $array,
        ComponentInterface $componentToJson = null,
        ComponentInterface $componentToXml = null
    ) {
        $this->componentToJson = $componentToJson ?? new ArrayToJson($array);
        $this->componentToXml = $componentToXml ?? new ArrayToXml($array);
    }

    /**
     * Convert array to json
     *
     * @param array $array
     * @return string
     */
    public static function convertToJson(array $array): string
    {
        $converter = new static($array);

        return $converter->convertTo(self::TYPE_JSON);
    }

    /**
     * Convert array to xml
     *
     * @param array $array
     * @return string
     */
    public static function convertToXml(array $array): string
    {
        $converter = new static($array);

        return $converter->convertTo(self::TYPE_XML);
    }

    /**
     * Convert array
     *
     * @param string $type
     * @return string
     * @throws InvalidType
     */
    public function convertTo(string $type): string
    {
        if ($type === self::TYPE_JSON) {
            return $this->componentToJson->convert();
        }

        if ($type === self::TYPE_XML) {
            return $this->componentToXml->convert();
        }

        throw new InvalidType(InvalidType::MESSAGE_NOT_FOUND_TYPE);
    }
}