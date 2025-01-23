<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\AddHostPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use TMV\HTTPlugModule\PluginFactory\AddHostFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class AddHostFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreatePlugin(): void
    {
        $uri = $this->prophesize(UriInterface::class);
        $uriFactory = $this->prophesize(UriFactoryInterface::class);
        $uriFactory->createUri('www.example.com')
            ->willReturn($uri->reveal());

        $factory = new AddHostFactory($uriFactory->reveal());

        $plugin = $factory->createPlugin([
            'host' => 'www.example.com',
            'options' => [],
        ]);

        $this->assertInstanceOf(AddHostPlugin::class, $plugin);
    }
}
