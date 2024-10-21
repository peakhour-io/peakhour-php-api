<?php

namespace PeakhourIo;

use Psr\Http\Message\ResponseInterface;

class Connection
{
    protected $params = [];

    protected $baseUri;

    /**
     * @var string
     */
    private $OSVersion = null;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function setAuthApiKey(string $apiKey)
    {
        $this->params['api_key'] = $apiKey;
    }

    public function performRequest(string $method, string $uri, $body = null, array $options = []): ResponseInterface
    {
        $gClient = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUri,
        ]);

        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->params['api_key'],
            ],
        ];

        if ($body) {
            $options['body'] = json_encode($body);
        }

        // Build the User-Agent using the format: <client-repo-name>/<client-version> (metadata-values)
        $options['headers']['User-Agent'] = sprintf(
            'peakhour-php-api/%s (%s %s; PHP %s)',
            \PeakhourIo\Client::VERSION,
            PHP_OS,
            $this->getOSVersion(),
            PHP_VERSION
        );

        $response = $gClient->request($method, $uri, $options);

        return $response;
    }


    /**
     * Get the OS version using php_uname if available
     * otherwise it returns an empty string
     *
     * @see https://github.com/elastic/elasticsearch-php/issues/922
     */
    private function getOSVersion(): string
    {
        if ($this->OSVersion === null) {
            $this->OSVersion = strpos(strtolower(ini_get('disable_functions')), 'php_uname') !== false
                ? ''
                : php_uname("r");
        }
        return $this->OSVersion;
    }
}