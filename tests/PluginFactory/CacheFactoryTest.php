<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\CachePlugin;
use Http\Message\StreamFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\CacheFactory;
use PHPUnit\Framework\TestCase;

class CacheFactoryTest extends TestCase
{

    public function testCreatePlugin(): void
    {
        $config = [
            'cache_pool' => 'foo',
            'stream_factory' => 'bar',
            'options' => [

            ],
        ];

        $cacheItemPool = $this->prophesize(CacheItemPoolInterface::class);
        $streamFactory = $this->prophesize(StreamFactory::class);
        $container = $this->prophesize(ContainerInterface::class);

        $container->get('foo')->willReturn($cacheItemPool->reveal());
        $container->get('bar')->willReturn($streamFactory->reveal());

        $factory = new CacheFactory($container->reveal());

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(CachePlugin::class, $plugin);
    }

    public function testCreatePluginWithDefaultStreamFactory(): void
    {
        $config = [
            'cache_pool' => 'foo',
            'options' => [

            ],
        ];

        $cacheItemPool = $this->prophesize(CacheItemPoolInterface::class);
        $streamFactory = $this->prophesize(StreamFactory::class);
        $container = $this->prophesize(ContainerInterface::class);

        $container->get('foo')->willReturn($cacheItemPool->reveal());
        $container->get('httplug.stream_factory')->willReturn($streamFactory->reveal());

        $factory = new CacheFactory($container->reveal());

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(CachePlugin::class, $plugin);
    }
}
