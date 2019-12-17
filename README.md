# Test Weather

## Commands
```bash
docker-compose up -d
docker exec -it test-weather-fpm composer install
```

## Example
```php
$httpRequestFactory = new RequestFactory();
$httpClient = GuzzleAdapter::createWithConfig([]);

$clientFactory = new WeatherFactory($httpRequestFactory, $httpClient);
$client = $clientFactory->create('openweathermap');
$client->setApiKey('SECRET-API-KEY');

$coordinates = [46.482, 30.723];
$response = $client->getWeather($coordinates);

$orderedArray = ArraySorter::sort(
    $response->jsonSerialize(),
    ['date', 'temperature', 'wind_direction']
);

$content = ArrayConverter::convertToJson($orderedArray);
// $content = ArrayConverter::convertToXml($orderedArray);

$adapter = new Local(__DIR__.'/path/to/root/');
$filesystem = new Filesystem($adapter);
$response = $filesystem->put('storage/file.json', $content);
```