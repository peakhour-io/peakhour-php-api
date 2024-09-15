<?php

namespace PeakhourIo\Namespaces;

class DomainsNamespace extends AbstractNamespace
{
    protected ?string $currentDomain = null;

    // PLACEHOLDERS:
    // GET /api/v1/domains
    // public function listDomains() {}
    // POST /api/v1/domains
    // public function addDomain(string $domain) {}

    public function setDomain(string $domain)
    {
        $this->currentDomain = $domain;
    }

    /**
     * Request to flush resources from CDN. If no paths are given, request to flush all resources.
     * -> DELETE /api/v1/domains/{domain}/services/rp/cdn/resources
     *
     * @param $paths
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function flushResources(array $paths = [])
    {
        if (is_null($this->currentDomain)) {
            throw new \Exception('currentDomain not set, cannot complete request');
        }
        $response = $this->performRequest([
            'endpoint' => $this->currentDomain . '/services/rp/cdn/resources',
            'method' => 'DELETE',
            //'params' => [],
            //'headers' => ['Bla-bla' => 'value'],
            'body' => [
                'paths' => $paths,
                'soft' => null,
            ],
        ]);

        return $response;
    }
}