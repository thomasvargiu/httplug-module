<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\HttpClient;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;
use PHPUnit\Framework\TestCase;

class AutoDiscoveryFactoryTest extends TestCase
{

    public function testCreateClient(): void
    {
        $factory = new AutoDiscoveryFactory();

        $clientFactory = $factory->createClient();
        $this->assertInstanceOf(HttpClient::class, $clientFactory);
    }
}
