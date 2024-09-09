<?php

namespace PeakhourIo\Namespaces;

class DomainsNamespace extends AbstractNamespace
{
    public function flushResources($domain, $paths)
    {
        $response = $this->performRequest([
            'endpoint' => $domain . '/services/rp/cdn/resources',
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