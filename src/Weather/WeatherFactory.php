<?php

declare(strict_types=1);

namespace Weather\Weather;

use Weather\Weather\Exception\InvalidApiProvider;
use Weather\Weather\Api\OpenWeatherMap;

class WeatherFactory extends HttpAbstract
{
    public const OPEN_WEATHER_MAP = 'openweathermap';

    /**
     * @param string $type
     * @return WeatherAbstract
     * @throws InvalidApiProvider
     */
    public function create(string $type): WeatherAbstract
    {
        if (strtolower($type) === self::OPEN_WEATHER_MAP) {
            return new OpenWeatherMap($this->getHttpClient(), $this->getHttpRequestFactory());
        }

        throw new InvalidApiProvider('Not found API provider');
    }
}