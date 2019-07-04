<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;

class AutoDiscoveryFactory implements ClientFactory
{
    public function createClient(array $config = []): HttpClient
    {
        return HttpClientDiscovery::find();
    }
}
