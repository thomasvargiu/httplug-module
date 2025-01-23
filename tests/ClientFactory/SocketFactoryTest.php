<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\Socket\Client;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\SocketFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class SocketFactoryTest extends TestCase
{
    use ProphecyTrait;
    protected function setUp(): void
    {
        parent::setUp();

        if (! \class_exists(Client::class)) {
            $this->markTestSkipped(sprintf('Class %s does not exist', Client::class));
        }
    }

    public function testCreateClient(): void
    {
        $factory = new SocketFactory();
        $client = $factory->createClient();

        $this->assertInstanceOf(Client::class, $client);
    }
}
