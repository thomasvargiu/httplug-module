<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\BaseUriPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use TMV\HTTPlugModule\PluginFactory\BaseUriFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class BaseUriFactoryTest extends TestCase
{
    use ProphecyTrait;

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
