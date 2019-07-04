<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Adapter\Guzzle5\Client;
use Http\Message\MessageFactory;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\Guzzle5Factory;

class Guzzle5FactoryTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        if (! \class_exists(Client::class)) {
            $this->markTestSkipped(sprintf('Class %s does not exist', Client::class));
        }
    }

    public function testCreateClient(): void
    {
        $messageFactory = $this->prophesize(MessageFactory::class);

        $factory = new Guzzle5Factory($messageFactory->reveal());
        $client = $factory->createClient();

        $this->assertInstanceOf(Client::class, $client);
    }
}
