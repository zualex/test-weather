<?php

declare(strict_types=1);

namespace Weather\Weather;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Weather\Weather\DTO\CoordinateDTO;
use Weather\Weather\DTO\WeatherDTO;

abstract class WeatherAbstract extends HttpAbstract implements WeatherInterface
{
    public const DEFAULT_UNIT = 'metric';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $unit;

    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $httpRequestFactory)
    {
        parent::__construct($httpClient, $httpRequestFactory);

        $this->setUnit(self::DEFAULT_UNIT);
    }

    /**
     * {@inheritDoc}
     */
    abstract public function getWeather(CoordinateDTO $coordinate): WeatherDTO;

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

    /**
     * Set unit name
     *
     * @param string $unit
     * @return WeatherAbstract
     */
    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get api key
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}