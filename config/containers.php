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
use League\Flysystem\AdapterInterface;
use League\Flysystem\Memory\MemoryAdapter;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\Filesystem;
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
    AdapterInterface::class => DI\factory(function (ContainerInterface $c) {
        if (getenv('APP_ENV') === 'testing') {
            return new MemoryAdapter();
        }

        return new Local(__DIR__ . '/../');
    }),
    FilesystemInterface::class => DI\factory(function (ContainerInterface $c) {
        $adapter = $c->get(AdapterInterface::class);

        return new Filesystem($adapter);
    }),
];