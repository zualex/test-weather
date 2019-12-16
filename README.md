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

$content = (new DataConverter())
    ->setArray($response->jsonSerialize())
    ->sortBy(['date', 'temperature', 'wind_direction'])
    ->convertTo('json')
    ->toString();

$storage = (new StorageFactory())->create('local');
$storage->save('storage/file.json', $content);
```