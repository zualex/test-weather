<?php

declare(strict_types=1);

use Weather\Weather\DTO\CoordinateDTO;

require_once __DIR__ . '/../config/bootstrap.php';

/* @var $app \Weather\App */

$coordinates = new CoordinateDTO(44.58883, 33.5224);
$response = $app->getWeather($coordinates);

$app->saveAsSortedJson(
    '/storage/response.json',
    $response->jsonSerialize(),
    ['date', 'temperature', 'wind_direction']
);