<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\Curl\Client;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TMV\HTTPlugModule\ClientFactory\CurlFactory;
use PHPUnit\Framework\TestCase;

class CurlFactoryTest extends TestCase
{

    public function testCreateClient(): void
    {
        $responseFactory = $this->prophesize(ResponseFactoryInterface::class);
        $streamFactory = $this->prophesize(StreamFactoryInterface::class);

        $factory = new CurlFactory($responseFactory->reveal(), $streamFactory->reveal());

        $client = $factory->createClient([\CURL_HTTP_VERSION_1_1]);

        $this->assertInstanceOf(Client::class, $client);
    }
}
