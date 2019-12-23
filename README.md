# Test Weather

Задача:

Необходимо реализовать функционал, который будет получать информацию о погоде из любого публичного API.
Он должен уметь сохранять полученные данные в файле формата json и xml в зависимости от переданного в него параметра типа файла.

Для JSON первыми по порядку должны быть поля:
Дата
Температура
Направление ветра
т.д.

Для XML:
Дата
Скорость ветра
Температура
т.д.

## Installation
```bash
docker-compose up -d
docker exec -it test-weather-fpm composer install
```

#### Create .env
```bash
docker exec -it test-weather-fpm \
    php -r "file_exists('.env') || copy('.env.example', '.env');"
```

#### Test api key for openweathermap
```bash
API_KEY_OPEN_WEATHER_MAP=8fdbb55f944e5243a5e0a221e0a561e4
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
- [response.json](examples/response.example.json)
- [response.xml](examples/response.example.xml)


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
