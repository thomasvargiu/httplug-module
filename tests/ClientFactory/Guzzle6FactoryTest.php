<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Adapter\Guzzle6\Client;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\Guzzle6Factory;

class Guzzle6FactoryTest extends TestCase
{
    public function testCreateClient(): void
    {
        $factory = new Guzzle6Factory();

        $client = $factory->createClient([]);

        $this->assertInstanceOf(Client::class, $client);
    }
}
