<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\HttpClient;
use Http\Mock\Client;
use TMV\HTTPlugModule\ClientFactory\MockFactory;
use PHPUnit\Framework\TestCase;

class MockFactoryTest extends TestCase
{

    public function testCreateClient(): void
    {
        $factory = new MockFactory();

        $client = $factory->createClient();

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testCreateClientWithCustomClient(): void
    {
        $depClient = $this->prophesize(HttpClient::class);
        $factory = new MockFactory($depClient->reveal());

        $client = $factory->createClient();

        $this->assertSame($depClient->reveal(), $client);
    }
}
