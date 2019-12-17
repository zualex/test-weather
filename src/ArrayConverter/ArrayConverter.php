<?php

declare(strict_types=1);

namespace Weather\ArrayConverter;

use Weather\ArrayConverter\Component\ArrayToJson;
use Weather\ArrayConverter\Component\ArrayToXml;
use Weather\ArrayConverter\Exception\InvalidType;

class ArrayConverter implements ArrayConverterInterface
{
    /**
     * @var ComponentInterface
     */
    private $componentToJson;

    /**
     * @var ComponentInterface
     */
    private $componentToXml;

    /**
     * @param ComponentInterface|null $componentToJson
     * @param ComponentInterface|null $componentToXml
     */
    public function __construct(
        ComponentInterface $componentToJson = null,
        ComponentInterface $componentToXml = null
    ) {
        $this->componentToJson = $componentToJson ?? new ArrayToJson();
        $this->componentToXml = $componentToXml ?? new ArrayToXml();
    }

    /**
     * {@inheritDoc}
     */
    public function convertToJson(array $array): string
    {
        return $this->convertTo(self::TYPE_JSON, $array);
    }

    /**
     * {@inheritDoc}
     */
    public function convertToXml(array $array): string
    {
        return $this->convertTo(self::TYPE_XML, $array);
    }

    /**
     * Convert array
     *
     * @param string $type
     * @param array $array
     * @return string
     * @throws InvalidType
     */
    public function convertTo(string $type, array $array): string
    {
        if ($type === self::TYPE_JSON) {
            return $this->componentToJson->convert($array);
        }

        if ($type === self::TYPE_XML) {
            return $this->componentToXml->convert($array);
        }

        throw new InvalidType(InvalidType::MESSAGE_NOT_FOUND_TYPE);
    }
}