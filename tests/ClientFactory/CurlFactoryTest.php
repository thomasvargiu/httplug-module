<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Http\Client\Curl\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TMV\HTTPlugModule\ClientFactory\CurlFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class CurlFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreateClient(): void
    {
        $responseFactory = $this->prophesize(ResponseFactoryInterface::class);
        $streamFactory = $this->prophesize(StreamFactoryInterface::class);

        $factory = new CurlFactory($responseFactory->reveal(), $streamFactory->reveal());

        $client = $factory->createClient([\CURL_HTTP_VERSION_1_1]);

        $this->assertInstanceOf(Client::class, $client);
    }
}
