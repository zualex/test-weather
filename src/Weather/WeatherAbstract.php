<?php

declare(strict_types=1);

namespace Weather\Weather;

use Weather\Weather\DTO\CoordinateDTO;
use Weather\Weather\DTO\WeatherDTO;

abstract class WeatherAbstract extends HttpAbstract
{
    /**
     * Get weather
     *
     * @param CoordinateDTO $coordinate
     * @param string $unit
     * @return WeatherDTO
     */
    abstract public function getWeather(CoordinateDTO $coordinate, string $unit): WeatherDTO;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Set api key
     *
     * @param string $apiKey
     * @return WeatherAbstract
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get api key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}