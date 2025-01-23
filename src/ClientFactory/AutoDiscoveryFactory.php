<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;

class AutoDiscoveryFactory implements ClientFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface
    {
        return Psr18ClientDiscovery::find();
    }
}
