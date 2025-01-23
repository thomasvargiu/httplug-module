<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class AutoDiscoveryFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreateClient(): void
    {
        $factory = new AutoDiscoveryFactory();

        $clientFactory = $factory->createClient();
        $this->assertInstanceOf(HttpClient::class, $clientFactory);
    }
}
