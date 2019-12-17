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
     *
     * @throws \Cmfcmf\OpenWeatherMap\Exception
     */
    public function getWeather(CoordinateDTO $coordinate): WeatherDTO
    {
        $query = [
            'lat' => $coordinate->getLat(),
            'lon' => $coordinate->getLon(),
        ];

        $client = $this->getClient();
        $response = $client->getWeather($query, $this->getUnit());

        $date = $response->lastUpdate;
        $temperature = new UnitDTO($response->temperature->now->getValue(), $response->temperature->now->getUnit());
        $pressure = new UnitDTO($response->pressure->getValue(), $response->pressure->getUnit());
        $humidity = new UnitDTO($response->humidity->getValue(), $response->humidity->getUnit());
        $windSpeed = new UnitDTO($response->wind->speed->getValue(), $response->wind->speed->getUnit());
        $windDirection = new UnitDTO($response->wind->direction->getValue(), $response->wind->direction->getUnit());

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