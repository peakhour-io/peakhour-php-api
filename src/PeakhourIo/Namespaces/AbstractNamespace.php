<?php

namespace PeakhourIo\Namespaces;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractNamespace
{
    protected $baseUri;

    protected array $connectionParams;

    public function __construct(array $connectionParams, string $baseUri)
    {
        $this->connectionParams = $connectionParams;
        $this->baseUri = $baseUri;
    }

    protected function performRequest(array $params): ResponseInterface
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $method = $this->extractArgument($params, 'method');
        $uri = $this->extractArgument($params, 'endpoint');

        $response = $client->request($method, $uri, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->connectionParams['api_key'],
                //'Content-Type' => 'application/json',
                //'Peakhour-Request-Url' => $request_url,
                //'Peakhour-Referrer-Url' => $ref,
                //'Peakhour-Php-Ver' => PHP_VERSION
            ],
        ]);

        return $response;
    }

    /**
     * @return null|mixed
     */
    public function extractArgument(array &$params, string $arg)
    {
        if (array_key_exists($arg, $params) === true) {
            $val = $params[$arg];
            unset($params[$arg]);
            return $val;
        } else {
            return null;
        }
    }
}