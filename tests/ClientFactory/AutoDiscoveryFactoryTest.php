<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;

class AutoDiscoveryFactoryTest extends TestCase
{
    public function testCreateClient(): void
    {
        $factory = new AutoDiscoveryFactory();

        $clientFactory = $factory->createClient();
        $this->assertInstanceOf(HttpClient::class, $clientFactory);
    }
}
