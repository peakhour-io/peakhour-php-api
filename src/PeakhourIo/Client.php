<?php

namespace PeakhourIo;

use PeakhourIo\Namespaces\DomainsNamespace;

class Client
{
    protected array $connectionParams = [];

    protected $baseUri;

    protected ?DomainsNamespace $domains = null;

    public function __construct($params = [])
    {
        $this->baseUri = $params['base_uri'];
    }

    public function setAuthApiKey(string $apiKey)
    {
        $this->connectionParams['api_key'] = $apiKey;

        return $this;
    }

    public function domains(): DomainsNamespace
    {
        if (is_null($this->domains)) {
            $this->domains = new DomainsNamespace($this->connectionParams, $this->baseUri);
        }
        return $this->domains;
    }

}