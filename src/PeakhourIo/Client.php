<?php

namespace PeakhourIo;

use PeakhourIo\Namespaces\DomainsNamespace;

class Client
{
    /**
     * @var DomainsNamespace
     */
    protected $domains;

    protected $baseUri;

    public function __construct($params = [])
    {
        $this->baseUri = $params['base_uri'];

        $this->domains = new DomainsNamespace($this->baseUri);
    }

    public function domains(): DomainsNamespace
    {
        return $this->domains;
    }

}