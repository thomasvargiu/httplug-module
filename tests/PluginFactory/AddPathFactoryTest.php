<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\AddPathPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use TMV\HTTPlugModule\PluginFactory\AddPathFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class AddPathFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $uri = $this->prophesize(UriInterface::class);
        $uriFactory = $this->prophesize(UriFactoryInterface::class);
        $uriFactory->createUri('/foo')
            ->willReturn($uri->reveal());

        $uri->getPath()->willReturn('/foo');

        $factory = new AddPathFactory($uriFactory->reveal());

        $plugin = $factory->createPlugin([
            'path' => '/foo',
        ]);

        $this->assertInstanceOf(AddPathPlugin::class, $plugin);
    }
}
