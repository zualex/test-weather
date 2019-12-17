<?php

declare(strict_types=1);

namespace Weather\Weather;

use Weather\Weather\DTO\CoordinateDTO;
use Weather\Weather\DTO\WeatherDTO;

interface WeatherInterface
{
    public function getWeather(CoordinateDTO $coordinate): WeatherDTO;
}