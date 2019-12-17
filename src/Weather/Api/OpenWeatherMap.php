<?php

declare(strict_types=1);

namespace Weather\Weather\Api;

use Weather\Weather\DTO\CoordinateDTO;
use Weather\Weather\DTO\UnitDTO;
use Weather\Weather\DTO\WeatherDTO;
use Weather\Weather\WeatherAbstract;
use Cmfcmf\OpenWeatherMap as OriginalOpenWeatherMap;

class OpenWeatherMap extends WeatherAbstract
{
    /**
     * @var OriginalOpenWeatherMap
     */
    private $client;

    /**
     * {@inheritDoc}
     */
    public function getWeather(CoordinateDTO $coordinate, string $unit): WeatherDTO
    {
        $client = $this->getClient();

        // TODO get real data for client

        $date = new \DateTime('now');
        $temperature = new UnitDTO(10, 'celsius');
        $pressure = new UnitDTO(5, 'hPa');
        $humidity = new UnitDTO(80, '%');
        $windSpeed = new UnitDTO(1, 'm/s');
        $windDirection = new UnitDTO(140, 'SE');

        return new WeatherDTO($date, $temperature, $pressure, $humidity, $windSpeed, $windDirection);
    }

    /**
     * Get vendor class for OpenWeatherMap
     *
     * @return OriginalOpenWeatherMap
     */
    private function getClient(): OriginalOpenWeatherMap
    {
        if ($this->client === null) {
            $this->client = new OriginalOpenWeatherMap(
                $this->getApiKey(),
                $this->getHttpClient(),
                $this->getHttpRequestFactory()
            );
        }

        return $this->client;
    }
}