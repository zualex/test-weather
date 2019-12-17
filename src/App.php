<?php

declare(strict_types=1);

namespace Weather;

use League\Flysystem\FilesystemInterface;
use Psr\Container\ContainerInterface;
use Weather\ArrayConverter\ArrayConverterInterface;
use Weather\ArraySorter\ArraySorterInterface;
use Weather\Weather\DTO\CoordinateDTO;
use Weather\Weather\DTO\WeatherDTO;
use Weather\Weather\WeatherInterface;

class App
{
    /**
     * @var WeatherInterface
     */
    private $weatherClient;

    /**
     * @var ArraySorterInterface
     */
    private $arraySorter;

    /**
     * @var ArrayConverterInterface
     */
    private $arrayConverter;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    public function __construct(ContainerInterface $container)
    {
        $this->weatherClient = $container->get(WeatherInterface::class);
        $this->arraySorter = $container->get(ArraySorterInterface::class);
        $this->arrayConverter = $container->get(ArrayConverterInterface::class);
        $this->filesystem = $container->get(FilesystemInterface::class);
    }

    /**
     * Get weather from api
     *
     * @param CoordinateDTO $coordinate
     * @return WeatherDTO
     */
    public function getWeather(CoordinateDTO $coordinate): WeatherDTO
    {
        return $this->weatherClient->getWeather($coordinate);
    }

    /**
     * Save array as sorted json
     *
     * @param string $fileName
     * @param array $array
     * @param array $arrayDirection
     * @return bool
     */
    public function saveAsSortedJson(string $fileName, array $array, array $arrayDirection): bool
    {
        $orderedArray = $this->arraySorter::sort($array, $arrayDirection);
        $content = $this->arrayConverter::convertToJson($orderedArray);

        return $this->filesystem->put($fileName, $content);
    }

    /**
     * Save array as sorted xml
     *
     * @param string $fileName
     * @param array $array
     * @param array $arrayDirection
     * @return bool
     */
    public function saveAsSortedXml(string $fileName, array $array, array $arrayDirection): bool
    {
        $orderedArray = $this->arraySorter::sort($array, $arrayDirection);
        $content = $this->arrayConverter::convertToXml($orderedArray);

        return $this->filesystem->put($fileName, $content);
    }
}