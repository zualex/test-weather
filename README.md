# Test Weather

## Start
```bash
docker-compose up -d
docker exec -it test-weather-fpm composer install
```

## Run unit tests
```bash
docker exec -it test-weather-fpm vendor/bin/phpunit
```

## Save to JSON

```bash
docker exec -it test-weather-fpm  \
    php examples/save-weather-to-json.php \
    && cat storage/response.json
```

## Save to JSON
```bash
docker exec -it test-weather-fpm  \
    php examples/save-weather-to-xml.php \
    && cat storage/response.xml
```

## Example saved files
```bash
docker exec -it test-weather-fpm  \
    cat storage/response.example.json \
    && cat storage/response.example.xml
```

## Example code
```php
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
```