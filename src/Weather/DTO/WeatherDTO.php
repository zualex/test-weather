<?php

declare(strict_types=1);

namespace Weather\Weather\DTO;

class WeatherDTO implements \JsonSerializable
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var UnitDTO
     */
    private $temperature;

    /**
     * @var UnitDTO
     */
    private $pressure;

    /**
     * @var UnitDTO
     */
    private $humidity;

    /**
     * @var UnitDTO
     */
    private $windSpeed;

    /**
     * @var UnitDTO
     */
    private $windDirection;

    /**
     * @param \DateTimeInterface $date
     * @param UnitDTO $temperature
     * @param UnitDTO $pressure
     * @param UnitDTO $humidity
     * @param UnitDTO $windSpeed
     * @param UnitDTO $windDirection
     */
    public function __construct(
        \DateTimeInterface $date,
        UnitDTO $temperature,
        UnitDTO $pressure,
        UnitDTO $humidity,
        UnitDTO $windSpeed,
        UnitDTO $windDirection
    ) {
        $this->date = $date;
        $this->temperature = $temperature;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'date' => $this->getDate()->getTimestamp(),
            'temperature' => $this->getTemperature()->jsonSerialize(),
            'pressure' => $this->getPressure()->jsonSerialize(),
            'humidity' => $this->getHumidity()->jsonSerialize(),
            'wind_speed' => $this->getWindSpeed()->jsonSerialize(),
            'wind_direction' => $this->getWindDirection()->jsonSerialize(),
        ];
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return UnitDTO
     */
    public function getTemperature(): UnitDTO
    {
        return $this->temperature;
    }

    /**
     * @return UnitDTO
     */
    public function getPressure(): UnitDTO
    {
        return $this->pressure;
    }

    /**
     * @return UnitDTO
     */
    public function getHumidity(): UnitDTO
    {
        return $this->humidity;
    }

    /**
     * @return UnitDTO
     */
    public function getWindSpeed(): UnitDTO
    {
        return $this->windSpeed;
    }

    /**
     * @return UnitDTO
     */
    public function getWindDirection(): UnitDTO
    {
        return $this->windDirection;
    }
}