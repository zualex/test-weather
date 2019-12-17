<?php

declare(strict_types=1);

use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Weather\Weather\WeatherFactory;
use Weather\Weather\DTO\CoordinateDTO;
use Weather\ArraySorter\ArraySorter;
use Weather\ArrayConverter\ArrayConverter;

require_once __DIR__ . '/bootstrap.php';

$httpClient = GuzzleAdapter::createWithConfig([]);
$httpRequestFactory = new RequestFactory();

$clientFactory = new WeatherFactory($httpClient, $httpRequestFactory);
$client = $clientFactory->create(getenv('API_DRIVER'));
$client->setApiKey(getenv('API_KEY_OPEN_WEATHER_MAP'));

$coordinates = new CoordinateDTO(44.58883, 33.5224);
$response = $client->getWeather($coordinates);

$orderedArray = ArraySorter::sort(
    $response->jsonSerialize(),
    ['date', 'temperature', 'wind_direction']
);

$content = ArrayConverter::convertToJson($orderedArray);

$adapter = new Local(__DIR__ . '/');
$filesystem = new Filesystem($adapter);
$response = $filesystem->put('file.json', $content);
