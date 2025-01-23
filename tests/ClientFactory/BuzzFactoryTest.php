<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\ClientFactory;

use Buzz\Client\FileGetContents;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use TMV\HTTPlugModule\ClientFactory\BuzzFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class BuzzFactoryTest extends TestCase
{
    use ProphecyTrait;

    protected function setUp(): void
    {
        parent::setUp();

        if (! \class_exists(FileGetContents::class)) {
            $this->markTestSkipped(sprintf('Class %s does not exist', FileGetContents::class));
        }
    }

    public function testCreateClient(): void
    {
        $responseFactory = $this->prophesize(ResponseFactoryInterface::class);

        $factory = new BuzzFactory($responseFactory->reveal());
        $client = $factory->createClient();

        $this->assertInstanceOf(FileGetContents::class, $client);
    }
}
