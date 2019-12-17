<?php

declare(strict_types=1);

namespace Weather\Weather\DTO;

class CoordinateDTO
{
    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $lon;

    /**
     * @param float $lat
     * @param float $lon
     */
    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }
}