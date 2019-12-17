<?php

declare(strict_types=1);

namespace Weather\Weather;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

abstract class HttpAbstract
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    private $httpRequestFactory;

    /**
     * WeatherFactory constructor.
     *
     * @param ClientInterface $httpClient A PSR-18 compatible HTTP client implementation.
     * @param RequestFactoryInterface $httpRequestFactory A PSR-17 compatible HTTP request factory implementation.
     */
    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $httpRequestFactory)
    {
        $this->httpClient = $httpClient;
        $this->httpRequestFactory = $httpRequestFactory;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getHttpRequestFactory(): RequestFactoryInterface
    {
        return $this->httpRequestFactory;
    }
}