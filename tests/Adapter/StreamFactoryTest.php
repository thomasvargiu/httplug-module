<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\Adapter;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use TMV\HTTPlugModule\Adapter\StreamFactory;

class StreamFactoryTest extends TestCase
{
    public function testCreateStream(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $psrStreamFactory = $this->prophesize(StreamFactoryInterface::class);
        $factory = new StreamFactory($psrStreamFactory->reveal());

        $psrStreamFactory->createStream('foo')
            ->willReturn($stream->reveal());

        $result = $factory->createStream('foo');

        $this->assertSame($stream->reveal(), $result);
    }

    public function testCreateStreamFromNull(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $psrStreamFactory = $this->prophesize(StreamFactoryInterface::class);
        $factory = new StreamFactory($psrStreamFactory->reveal());

        $psrStreamFactory->createStream('')
            ->willReturn($stream->reveal());

        $result = $factory->createStream();

        $this->assertSame($stream->reveal(), $result);
    }

    public function testCreateStreamFromResource(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $psrStreamFactory = $this->prophesize(StreamFactoryInterface::class);
        $factory = new StreamFactory($psrStreamFactory->reveal());

        /** @var resource $resource */
        $resource = \fopen('php://temp', 'wb+');

        $psrStreamFactory->createStreamFromResource($resource)
            ->willReturn($stream->reveal());

        $result = $factory->createStream($resource);

        $this->assertSame($stream->reveal(), $result);
    }
}
