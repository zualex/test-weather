<?php

declare(strict_types=1);

namespace Weather\Weather\DTO;

class UnitDTO implements \JsonSerializable
{
    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $unit;

    /**
     * @param float $value
     * @param string $unit
     */
    public function __construct(float $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->getValue(),
            'unit' => $this->getUnit(),
        ];
    }

    /**
     * Get value unit
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * get unit name
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}