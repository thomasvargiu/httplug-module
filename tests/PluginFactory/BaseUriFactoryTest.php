<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\BaseUriPlugin;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\BaseUriFactory;

class BaseUriFactoryTest extends TestCase
{

    public function testCreatePlugin(): void
    {
        $uri = $this->prophesize(UriInterface::class);
        $uriFactory = $this->prophesize(UriFactoryInterface::class);

        $uriFactory->createUri('/foo')
            ->willReturn($uri->reveal());
        $uri->getPath()->willReturn('/foo');
        $uri->getHost()->willReturn('www.example.com');

        $factory = new BaseUriFactory($uriFactory->reveal());

        $plugin = $factory->createPlugin([
            'uri' => '/foo',
            'host_config' => [],
        ]);

        $this->assertInstanceOf(BaseUriPlugin::class, $plugin);
    }
}
