<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Weather\App;
use Weather\Weather\DTO\UnitDTO;
use Weather\Weather\DTO\WeatherDTO;

class AppTest extends TestCase
{
    public function testSaveAsSortedJson():void
    {
        $app = $this->getApp();
        $fileName = 'test.json';
        $arrayDirection = ['date', 'temperature', 'wind_direction'];
        $weatherDTO = $this->getWeatherDTO(10, 1024, 70, 4.05, 175, 's');

        $result = $app->saveAsSortedJson($fileName, $weatherDTO->jsonSerialize(), $arrayDirection);
        $sortedArray = $app->getArraySorter()->sort($weatherDTO->jsonSerialize(), $arrayDirection);
        $content = $app->getArrayConverter()->convertToJson($sortedArray);

        $this->assertTrue($result);
        $this->assertEquals($content, $app->getFilesystem()->read($fileName));
    }

    public function testSaveAsSortedXml():void
    {
        $app = $this->getApp();
        $fileName = 'test2.xml';
        $arrayDirection = ['date', 'wind_speed', 'temperature'];
        $weatherDTO = $this->getWeatherDTO(10, 1024, 70, 4.05, 175, 's');

        $result = $app->saveAsSortedXml($fileName, $weatherDTO->jsonSerialize(), $arrayDirection);
        $sortedArray = $app->getArraySorter()->sort($weatherDTO->jsonSerialize(), $arrayDirection);
        $content = $app->getArrayConverter()->convertToXml($sortedArray);

        $this->assertTrue($result);
        $this->assertEquals($content, $app->getFilesystem()->read($fileName));
    }

    /**
     * @return App
     */
    private function getApp(): App
    {
        return require __DIR__ . '/../config/app.php';
    }

    /**
     * @param float $temperature
     * @param float $pressure
     * @param float $humidity
     * @param float $windSpeed
     * @param float $windDirection
     * @param string $windDirectionUnit
     * @return WeatherDTO
     */
    private function getWeatherDTO(
        float $temperature,
        float $pressure,
        float $humidity,
        float $windSpeed,
        float $windDirection,
        string $windDirectionUnit
    ): WeatherDTO {
        $date = new \DateTime('now');
        $temperature = new UnitDTO($temperature, 'celsius');
        $pressure = new UnitDTO($pressure, 'hPa');
        $humidity = new UnitDTO($humidity, '%');
        $windSpeed = new UnitDTO($windSpeed, 'm/s');
        $windDirection = new UnitDTO($windDirection, $windDirectionUnit);

        return new WeatherDTO($date, $temperature, $pressure, $humidity, $windSpeed, $windDirection);
    }
}