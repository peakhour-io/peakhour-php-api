<?php

namespace PeakhourIo\Namespaces;

use PeakhourIo\Connection;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractNamespace
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    protected function performRequest(array $params): ResponseInterface
    {
        $method = $this->extractArgument($params, 'method');
        $uri = $this->extractArgument($params, 'endpoint');
        $body = $this->extractArgument($params, 'body');

        $response = $this->connection->performRequest($method, $uri, $body);

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