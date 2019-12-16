# Test Weather

## Example
```php
$httpRequestFactory = new RequestFactory();
$httpClient = GuzzleAdapter::createWithConfig([]);

$clientFactory = new WeatherFactory($httpRequestFactory, $httpClient);
$client = $clientFactory->create('openweathermap');
$client->setApiKey('SECRET-API-KEY');

$coordinates = [46.482, 30.723];
$response = $client->getWeather($coordinates);

$arraySorter = new ArraySorter();
$arraySorter->set($response->jsonSerialize());
$arraySorter->sortBy(['date', 'temperature', 'wind_direction']);
$content = $arraySorter->get();

$storage = (new StorageFactory())->create('local');
$storage->setContentAsArray($content);
$storage->convertContentTo('json');
$storage->save('storage/file.json');
```