# peakhour-io/peakhour-api

Idiomatic PHP client for https://www.peakhour.io/api/explore/ using Guzzle.

## Installation

`composer require peakhour-io/peakhour-api`

(and the usual )
## Usage


```php
$client = (new \PeakhourIo\Client(['base_uri' => 'https://www.peakhour.io']))
    ->setAuthApiKey('<API_KEY>')
    ->setDomain('www.example.com');
$response = $client->domains()->flushResources([
    '/about',
    '/blog/1337
]);

$code = $response->getStatusCode();
if ($code !== 202) {
    // Error handling (...)
}
```

## Misc

This client is inspired from the design of https://github.com/opensearch-project/opensearch-php, but simpler.
The aim here is to have a library easy and intuitive to use in applications,
by following common designs in API client. Peakhour.io/api is a 140-endpoints big API.
In the current stage this client is implementing 2 endpoints (purge functionality).
It is possible and it is intended to extend it to more endpoints when required.

The library embraces the concept of namespace to separate the endpoints into group of functionalities
thus reducing the complexity. The Connection part is a light wrapper around Guzzle,
miming its interface and handling authentication and data encoding.
