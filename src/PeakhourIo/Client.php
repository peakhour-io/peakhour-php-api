<?php

namespace PeakhourIo;

use PeakhourIo\Namespaces\DomainsNamespace;

class Client
{
    public const VERSION = '0.1.0';

    protected Connection $connection;

    protected ?DomainsNamespace $domains = null;

    public function __construct($params = [])
    {
        $this->connection = new Connection($params['base_uri']);
    }

    public function setAuthApiKey(string $apiKey): Client
    {
        $this->connection->setAuthApiKey($apiKey);

        return $this;
    }

    /**
     * Delegate domains related requests (/api/v1/domains/*) to dedicated class DomainsNamespace
     *
     * @param string|null $currentDomain optional param to set the domain
     *      (as /api/v1/domains/<currentDomain/*)
     * @return DomainsNamespace
     */
    public function domains(string $currentDomain = null): DomainsNamespace
    {
        if (is_null($this->domains)) {
            $this->domains = new DomainsNamespace($this->connection);
        }
        if ($currentDomain) {
            $this->setDomain($currentDomain);
        }
        return $this->domains;
    }

    /**
     * Syntactic sugar to set the default domain from the client in fluent fashion.
     *
     * @param string $domain
     * @return $this
     */
    public function setDomain(string $domain): Client
    {
        $this->domains->setDomain($domain);
        return $this;
    }

}