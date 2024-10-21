<?php

namespace PeakhourIo\Namespaces;

use Psr\Http\Message\ResponseInterface;

class DomainsNamespace extends AbstractNamespace
{
    protected $currentDomain = null;

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
     * @param array $paths
     * @param bool $soft
     * @return ResponseInterface
     * @throws \Exception
     */
    public function flushResources(array $paths = [], bool $soft = false): ResponseInterface
    {
        if (is_null($this->currentDomain)) {
            throw new \Exception('currentDomain not set, cannot complete request');
        }
        $response = $this->performRequest([
            'endpoint' => "/api/v1/domains/{$this->currentDomain}/services/rp/cdn/resources",
            'method' => 'DELETE',
            'body' => [
                'paths' => $paths,
                'soft' => $soft,
            ],
        ]);

        return $response;
    }

    /**
     * Request to flush resources from CDN by tags
     * -> DELETE /api/v1/domains/{domain}/services/rp/cdn/tag
     *
     * @param array $tags
     * @param bool $soft
     * @return ResponseInterface
     * @throws \Exception
     */
    public function flushResourcesByTag(array $tags = [], bool $soft = false): ResponseInterface
    {
        if (is_null($this->currentDomain)) {
            throw new \Exception('currentDomain not set, cannot complete request');
        }
        $response = $this->performRequest([
            'endpoint' => "/api/v1/domains/{$this->currentDomain}/services/rp/cdn/tag",
            'method' => 'DELETE',
            'body' => [
                'tags' => $tags,
                'soft' => $soft,
            ],
        ]);

        return $response;
    }
}