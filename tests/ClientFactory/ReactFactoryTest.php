<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Adapter\React\Client;
use Http\Message\MessageFactory;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\ReactFactory;

class ReactFactoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! \class_exists(Client::class)) {
            $this->markTestSkipped(sprintf('Class %s does not exist', Client::class));
        }
    }

    public function testCreateClient(): void
    {
        $messageFactory = $this->prophesize(MessageFactory::class);

        $factory = new ReactFactory($messageFactory->reveal());
        $client = $factory->createClient();

        $this->assertInstanceOf(Client::class, $client);
    }
}
