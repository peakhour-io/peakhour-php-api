<?php

namespace PeakhourIo\Namespaces;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractNamespace
{
    protected $baseUri;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    protected function performRequest(array $params): ResponseInterface
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $method = $this->extractArgument($params, 'method');
        $uri = $this->extractArgument($params, 'endpoint');

        $response = $client->request($method, $uri);

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