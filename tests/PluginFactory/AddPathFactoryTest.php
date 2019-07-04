<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\AddPathPlugin;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\AddPathFactory;

class AddPathFactoryTest extends TestCase
{

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
