<?php

declare(strict_types=1);

use Weather\Weather\WeatherInterface;
use Weather\Weather\WeatherFactory;
use Weather\ArraySorter\ArraySorterInterface;
use Weather\ArraySorter\ArraySorter;
use Weather\ArrayConverter\ArrayConverter;
use Weather\ArrayConverter\ArrayConverterInterface;
use Psr\Http\Client\ClientInterface;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Psr\Http\Message\RequestFactoryInterface;
use Http\Factory\Guzzle\RequestFactory;
use Psr\Container\ContainerInterface;
use function DI\factory;

return [
    ClientInterface::class => DI\factory(function (ContainerInterface $c) {
        return GuzzleAdapter::createWithConfig([]);
    }),
    RequestFactoryInterface::class => DI\create(RequestFactory::class),
    WeatherInterface::class => DI\factory(function (ContainerInterface $c) {
        $httpClient = $c->get(\Psr\Http\Client\ClientInterface::class);
        $httpRequestFactory = $c->get(\Psr\Http\Message\RequestFactoryInterface::class);

        $clientFactory = new WeatherFactory($httpClient, $httpRequestFactory);
        $client = $clientFactory->create(getenv('API_DRIVER'));
        $client->setApiKey(getenv('API_KEY_OPEN_WEATHER_MAP'));

        return $client;
    }),
    ArraySorterInterface::class => DI\create(ArraySorter::class),
    ArrayConverterInterface::class => DI\create(ArrayConverter::class),
    \League\Flysystem\AdapterInterface::class => DI\factory(function (ContainerInterface $c) {
        if (getenv('APP_ENV') === 'testing') {
            return new \League\Flysystem\Memory\MemoryAdapter();
        }

        return new \League\Flysystem\Adapter\Local(__DIR__ . '/../');
    }),
    \League\Flysystem\FilesystemInterface::class => DI\factory(function (ContainerInterface $c) {
        $adapter = $c->get(\League\Flysystem\AdapterInterface::class);

        return new \League\Flysystem\Filesystem($adapter);
    }),
];